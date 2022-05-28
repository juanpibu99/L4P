<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils, EntityManagerInterface $em): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        if($error!=null){
            $error="Has introducido mal tus datos";
        }
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/login.html.twig', [
            'controller_name' => 'LoginController',
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    /**
     * @Route("/", name="redirect")
     */
    public function redirected(Security $sec): Response
    {
        $user=$sec->getUser()->getRoles();
        if(in_array("ROLE_ADMIN",$user)){
            return $this->redirectToRoute('app_adminIndex');
        }else {
            return $this->redirectToRoute('app_index');
        }
        
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): void
    {
        throw new \Exception('');
    }
}
