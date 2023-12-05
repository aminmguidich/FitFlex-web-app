<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationController extends AbstractController
{
    #[Route('/reclamation', name: 'app_reclamation')]
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }
    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
{
    // Check if the form is submitted
    if ($request->isMethod('POST')) {
        $description = $request->request->get('description');
        $userId = $request->request->get('user_id');

        // Fetch the user by ID
        $user = $userRepository->find($userId);

        if (!$user) {
            // Handle the case where the user with the specified ID is not found
            // You might want to return an error response or redirect to an error page
        }

        // Use QueryBuilder to insert a new Reclamation record
        $entityManager->createQueryBuilder()
            ->insert(Reclamation::class, 'r')
            ->values([
                'r.description' => ':description',
                'r.user' => ':user',
            ])
            ->setParameter('description', $description)
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();

        return $this->redirectToRoute('app_reclamation_index');
    }

    return $this->render('reclamation/new.html.twig');
}

}
