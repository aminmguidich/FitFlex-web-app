<?php

namespace App\Controller;

use App\Entity\ReservationOffer;
use App\Form\ReservationOfferType;
use App\Repository\ReservationOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation/offer')]
class ReservationOfferController extends AbstractController
{
    #[Route('/', name: 'app_reservation_offer_index', methods: ['GET'])]
    public function index(ReservationOfferRepository $reservationOfferRepository): Response
    {
        return $this->render('reservation_offer/index.html.twig', [
            'reservation_offers' => $reservationOfferRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_offer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationOffer = new ReservationOffer();
        $form = $this->createForm(ReservationOfferType::class, $reservationOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationOffer);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_offer/new.html.twig', [
            'reservation_offer' => $reservationOffer,
            'form' => $form,
        ]);
    }

    #[Route('/{idreservation}', name: 'app_reservation_offer_show', methods: ['GET'])]
    public function show(ReservationOffer $reservationOffer): Response
    {
        return $this->render('reservation_offer/show.html.twig', [
            'reservation_offer' => $reservationOffer,
        ]);
    }

    #[Route('/{idreservation}/edit', name: 'app_reservation_offer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationOffer $reservationOffer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationOfferType::class, $reservationOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_offer/edit.html.twig', [
            'reservation_offer' => $reservationOffer,
            'form' => $form,
        ]);
    }

    #[Route('/{idreservation}', name: 'app_reservation_offer_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationOffer $reservationOffer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationOffer->getIdreservation(), $request->request->get('_token'))) {
            $entityManager->remove($reservationOffer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_offer_index', [], Response::HTTP_SEE_OTHER);
    }
}
