<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
 /**
     * @Route("/register", name="user_register")
     */
    public function register(Request $request ,EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('img')->getData();

            // Generate a unique name for the file
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where your images are stored
            $file->move(
                $this->getParameter('your_images_directory'),
                $fileName
            );

            // Save the image name in the database
            $user->setImg($fileName);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
 /**
     * @Route("/save", name="user_save")
     */
    public function save(Request $req ,Connection $connection,UserPasswordEncoderInterface $passwordEncoder ){
        $fname =$req->get('fname'); 
        $lname =$req->get('lname'); 
        $email =$req->get('email'); 
        $password =$req->get('password'); 
        $age =$req->get('age'); 
        $user = new User();
        $hashedPassword = $passwordEncoder->encodePassword($user,$password);
        $data = [
            'nom' => $fname,
            'prenom' => $lname, 
            'email' => $email, 
            'mdp' =>   $hashedPassword,
            'role' => 'Utilisateur', 
            'img' => 'null', 
            'age' => $age, 
            // add more columns and values as needed
        ];

        $tableName = 'user';

        $query = 'INSERT INTO ' . $tableName . ' (' . implode(', ', array_keys($data)) . ') 
                  VALUES (' . implode(', ', array_map(function ($value) {
            return '\'' . $value . '\'';
        }, $data)) . ')';

        $statement = $connection->prepare($query);
      if(  $statement->execute()){
        return $this->redirectToRoute('app_login');
      }
    }
    #[Route('/profile', name: 'user_profile')]
    public function userProfile(): Response
    {
        // Fetch the user information from your data source (e.g., database)
        $user = $this->getUser(); // Assuming you're using Symfony's security system

        return $this->render('/home/profile.html.twig', [
            'user' => $user,
        ]);
    }
}
