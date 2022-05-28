<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegisterType;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function registro(UserPasswordHasherInterface $passwordHasher,Request $request,EntityManagerInterface $em): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        $error = "";
        if ($form->isSubmitted() && $form->isValid()) {
            $a = ['ROLE_USER'];
            $user->setRoles($a);
                $hashesPassword = $passwordHasher->hashPassword(
                    $user,
                    $form->get("password")->getData()
                );
            $user->setPassword($hashesPassword);
            $user->setEmail($form->get("email")->getData());
            $user->setNombre($form->get("nombre")->getData());
            $user->setVerificado(false);
            $usu = $em->getRepository(User::class)->findOneBy(array('username'=>$user->getUserIdentifier()));
            if (!$usu) {
                if ($form->get("password")->getData() == $form->get("repetir_password")->getData()) {
                    
                    try {
                        $em->persist($user);
                        $em->flush();
                    } catch (\Exception $e) {
                        return new Response("Esto ha petao");
                    }
                    return $this->redirectToRoute('login');
                } else {
                    $error = "Las contraseñas no coinciden";
                }
            } else {

                $error = "Ya existe ese nombre de usuario";
            }
        }

        return $this->render('register/register.html.twig', [
            'controller_name' => 'FormularioController',
            'form' => $form->createView(),
            'error' => $error
        ]);
    }
}
