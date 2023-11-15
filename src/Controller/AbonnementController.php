<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Form\AbonnementType;
use App\Repository\AbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TypeAbonn;
use App\Repository\TypeAbonnRepository;

#[Route('/abonnement')]
class AbonnementController extends AbstractController
{
    /*#[Route('/', name: 'app_abonnement_index', methods: ['GET'])]
    public function index(AbonnementRepository $abonnementRepository): Response
    {
        return $this->render('abonnement/index.html.twig', [
            'abonnements' => $abonnementRepository->findAll(),
        ]);
    }*/

    #[Route('/', name: 'affiche_TypeAbonn', methods: ['GET'])]
    public function index(TypeAbonnRepository $typeAbonnRepository): Response
    {
        return $this->render('abonnement/afiiche_TypeAbonn.html.twig', [
            'type_abonns' => $typeAbonnRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_abonnement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $abonnement = new Abonnement();
        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Incrémentation nombre des abonnement pour chaque typeAbonn
            $nb =  $abonnement->getTypeabon()->getNbAbonnement() + 1;
            $abonnement->getTypeabon()->setNbAbonnement($nb);

            $entityManager->persist($abonnement);
            $entityManager->flush();

            return $this->redirectToRoute('affiche_TypeAbonn', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->renderForm('abonnement/new.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form,
        ]);
    }

    #[Route('/{idabonement}', name: 'app_abonnement_show', methods: ['GET'])]
    public function show(Abonnement $abonnement): Response
    {
        return $this->render('abonnement/show.html.twig', [
            'abonnement' => $abonnement,
        ]);
    }

    /*#[Route('/{idabonement}/edit', name: 'app_abonnement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Abonnement $abonnement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('affiche_TypeAbonn', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('abonnement/edit.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form,
        ]);
    }*/

    #[Route('/{idabonement}', name: 'app_abonnement_delete', methods: ['POST'])]
    public function delete(Request $request, Abonnement $abonnement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abonnement->getIdabonement(), $request->request->get('_token'))) {
            $entityManager->remove($abonnement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('affiche_TypeAbonn', [], Response::HTTP_SEE_OTHER);
    }
}
