<?php

namespace App\Controller;

use App\Entity\Juego;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AltaJuegoType;
use Exception;
use Symfony\Component\String\Slugger\SluggerInterface;



/**
     * @Route("/admin")
     */
class AdminController extends AbstractController
{
    /**
     * @Route("/index", name="app_adminIndex")
     */
    public function index(Security $sec,EntityManagerInterface $em): Response
    {
        $user=$sec->getUser()->getUserIdentifier();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    

    /**
       * @Route("/altaJuego", name="app_altaJuego")
     */
    public function altaJuego(Request $request,EntityManagerInterface $em,SluggerInterface $slugger): Response
    {
        $juego = new Juego();
        $form = $this->createForm(AltaJuegoType::class, $juego);

        $form->handleRequest($request);
        $error = "";
        if ($form->isSubmitted() && $form->isValid()) {
            
            $juego->setCategoria($form->get("categoria")->getData());
            $juego->setNombre($form->get("nombre")->getData());
            $juego->setDescripcion($form->get("descripcion")->getData());
            $uploadedFile=$form->get("foto")->getData();
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
            $img=file_get_contents($form->get("foto")->getData());
            // Move the file to the directory where brochures are stored
               
            $uploadedFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
            $juego->setFoto($img);
            $error="";
            
            $game = $em->getRepository(Juego::class)->findOneBy(array('nombre'=>$juego->getNombre()));
            if (!$game) {
                
                    
                    try {
                        $em->persist($juego);
                        $em->flush();
                    } catch (\Exception $e) {
                        return new Response("Esto ha petao");
                    }
                    return $this->redirectToRoute('app_adminIndex');
               
            } else {

                $error = "Ya existe ese juego";
            }
        }

        return $this->render('admin/altaJuego.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }
}
