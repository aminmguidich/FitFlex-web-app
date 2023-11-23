<?php

namespace App\Controller;

use App\Entity\Events;
use App\Repository\EventsRepository;
use App\Form\EventsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_event_index', methods: ['GET'])]
    public function index(EventsRepository $eventsRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventsRepository->findAll(),
        ]);
    }

    #[Route('/list', name: 'app_event_indexf', methods: ['GET'])]
    public function index_front(EventsRepository $eventsRepository): Response
    {
        return $this->render('event/index_front.html.twig', [
            'events' => $eventsRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,QrCodeGenerator $qrCodeGenerator): Response
    {
        $event = new Events();
        $form = $this->createForm(EventsType::class, $event);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Generate a unique file name
            $file = $form->get('imgevent')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
    
            // Handle file upload
            $file = $form->get('imgevent')->getData();
    
            // Move the file to the desired location
            $file->move(
                $this->getParameter('images_directory'), // defined in services.yaml
                $fileName
            );
    
            // Set the file name in the entity
            $event->setImgevent($fileName);
    
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/new.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{idevent}', name: 'app_event_show', methods: ['GET'])]
    public function show(Events $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{idevent}/edit', name: 'app_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Events $event, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventsType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('imgevent')->getData();

            if ($file) {
                // Generate a unique name for the file
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
    
                // Move the file to the directory where images are stored
                $file->move(
                    $this->getParameter('images_directory'), // defined in services.yaml
                    $fileName
                );
    
                // Set the file name in the entity
                $event->setImgevent($fileName);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/edit.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }
    #[Route('/{idevent}', name: 'app_event_delete', methods: ['POST'])]
    public function delete(Request $request, Events $event, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getIdevent(), $request->request->get('_token'))) {
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    }
}
