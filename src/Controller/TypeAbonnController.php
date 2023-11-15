<?php

namespace App\Controller;

use App\Entity\TypeAbonn;
use App\Form\TypeAbonnType;
use App\Form\TypeAbonnementSearchType;
use App\Repository\TypeAbonnRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/abonn')]
class TypeAbonnController extends AbstractController
{
    #[Route('/', name: 'app_type_abonn_index', methods: ['GET', 'POST'])]
    public function index(Request $request,TypeAbonnRepository $typeAbonnRepository): Response
    {
          // Create the search form
        $searchForm = $this->createForm(TypeAbonnementSearchType::class);
        $searchForm->handleRequest($request);
        // Get the search query
       $searchQuery = $searchForm->get('search')->getData();

        // Use the repository method to find type abonnements based on the search query
    $typeAbonnements = $typeAbonnRepository->findBySearchQuery($searchQuery);

        return $this->render('type_abonn/index.html.twig', [
            'type_abonns' => $typeAbonnRepository->findAll(),
            'searchForm' => $searchForm->createView(),
        ]);
    }

    #[Route('/new', name: 'app_type_abonn_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeAbonn = new TypeAbonn();
        $form = $this->createForm(TypeAbonnType::class, $typeAbonn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeAbonn);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_abonn_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_abonn/new.html.twig', [
            'type_abonn' => $typeAbonn,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_abonn_show', methods: ['GET'])]
    public function show(TypeAbonn $typeAbonn): Response
    {
        return $this->render('type_abonn/show.html.twig', [
            'type_abonn' => $typeAbonn,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_abonn_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeAbonn $typeAbonn, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeAbonnType::class, $typeAbonn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_abonn_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_abonn/edit.html.twig', [
            'type_abonn' => $typeAbonn,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_abonn_delete', methods: ['POST'])]
    public function delete(Request $request, TypeAbonn $typeAbonn, EntityManagerInterface $entityManager , TypeAbonnRepository $typeAbonnRepository): Response
    {

        $abonnements = $typeAbonn->getNbAbonnement();

        if ($this->isCsrfTokenValid('delete'.$typeAbonn->getId(), $request->request->get('_token')) && $abonnements==0) {
            $entityManager->remove($typeAbonn);
            $entityManager->flush();
        }
        else {
            return  $this->render('type_abonn/errorDelete.html.twig');
        }

        return $this->redirectToRoute('app_type_abonn_index', [], Response::HTTP_SEE_OTHER);
    }

}
