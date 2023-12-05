<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // Last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        if ($this->getUser()) {
            $roles = $this->getUser()->getRoles();
           
           
        }
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
    /**
     * @Route("/redirect", name="app_redirect")
     */
    public function redirectT( ){

        $this->getUser();
        $roles = $this->getUser()->getRoles();
        if ($roles[0]=="Admin") {
            return $this->redirectToRoute('app_user_index');
        } elseif ($roles[0]=="Utilisateur") {
            return $this->redirectToRoute('user_profile');
        } elseif ($roles[0]=="Coach") {
            return $this->redirectToRoute('app_user_new');
        }
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        // This method can remain empty. It will be intercepted by the logout key on your firewall.
    }
}

?>