<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Juega;
use App\Entity\Juego;
use App\Entity\User;
/**
     * @Route("/forum")
     */
class UserController extends AbstractController
{
    /**
     * @Route("/index", name="app_index")
     */
    public function index(Security $sec,EntityManagerInterface $em): Response
    {
        $user=$sec->getUser()->getRoles();
        $userId=$sec->getUser()->getUserIdentifier();

        if(in_array("ROLE_ADMIN",$user)){
            return $this->redirectToRoute('app_adminIndex');
        }else {
            $juega=$em->getRepository(Juega::class)->findBy(array('usernameUser'=>$userId));
            if($juega!=null){
                return $this->render('user/index.html.twig', [
                    'controller_name' => 'UserController',
                ]);
            }else{
                $juegos = $em->getRepository(Juego::class)->findAll();
                
               
                return $this->render('user/addJuegosUser.html.twig', [
                    'user'=> $userId,
                    'juegos' => $juegos,
                
                    'controller_name' => 'UserController'
                ]);
            }

            
        }

       
    }

    
}
