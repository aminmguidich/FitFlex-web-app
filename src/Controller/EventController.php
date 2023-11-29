<?php

namespace App\Controller;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Events;
use App\Repository\EventsRepository;
use App\Form\EventsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchEventType;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/event')]
class EventController extends AbstractController
{
   /* #[Route('/', name: 'app_event_index', methods: ['GET'])]
    public function index(EventsRepository $eventsRepository): Response
    {
        $events = $eventsRepository->findBy([], ['dateevent' => 'DESC']);
        return $this->render('event/index.html.twig', [
            'events' => $events,
        ]);
    }*/
    
  /*  #[Route('/list', name: 'app_event_indexf', methods: ['GET'])]
    public function index_front(EventsRepository $eventsRepository): Response
    {
        return $this->render('event/index_front.html.twig', [
            'events' => $eventsRepository->findAll(),
        ]);
    }*/
    #[Route('/list', name: 'app_event_indexf', methods: ['GET', 'POST'])]
    public function index_front(Request $request, EventsRepository $eventsRepository): Response
    {
        $searchForm = $this->createForm(SearchEventType::class);
    $searchForm->handleRequest($request);

    // Check if the form is submitted and valid
    if ($searchForm->isSubmitted() && $searchForm->isValid()) {
        // Get the data from the form
        $searchData = $searchForm->getData();

        // Use the searchEvents method from the repository to get filtered events
        $events = $eventsRepository->searchEvents($searchData);
    } else {
        // If the form is not submitted or invalid, get all events
        $events = $eventsRepository->findAll();
    }
    return $this->render('event/index_front.html.twig', [
        'form' => $searchForm->createView(),
        'events' => $events,
    ]);
    }

    #[Route('/new', name: 'app_event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
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
        $participations = $event->getParticipations();

        return $this->render('event/show.html.twig', [
            'event' => $event,
            'participations' => $participations,
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
    private $entityManager;
    private $mailer;

    public function __construct(EntityManagerInterface $entityManager, MailerInterface $mailer)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }
    #[Route('/{idevent}', name: 'app_event_delete', methods: ['POST'])]
public function delete(Request $request, Events $event, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
{
    if ($this->isCsrfTokenValid('delete'.$event->getIdevent(), $request->request->get('_token'))) {
        // Get participants associated with the event
        $participations = $event->getParticipations();
        $this->addFlash('success', 'evenement supprimée avec succès!');

 
        // Notify participants by email
       foreach ($event->getParticipations() as $participation) {
            $this->sendNotificationEmail($participation->getIdUser().getEmail(), 'Event Deleted', 'The event has been canceled.');
       }
           // Remove the event
           $entityManager->remove($event);
           $entityManager->flush();
    }

    return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
}


private function sendNotificationEmail(string $recipientEmail, string $subject, string $message): void
{
    // Assuming you have configured mailer in your Symfony application
    $email = (new Email())
        ->from('ranim.abassi@esprit.tn')
        ->to($recipientEmail)
        ->subject($subject)
        ->text($message);

    $this->mailer->send($email);
}
#[Route('/search', name: 'app_event_search', methods: ['GET','POST'])]

public function search(Request $request, EventsRepository $eventsRepository): Response
{
    $form = $this->createForm(SearchEventType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $searchData = $form->getData();

        // Utilisez les données de recherche pour récupérer les résultats
        $results = $eventsRepository->searchEvents($searchData);

        return $this->render('event/search_results.html.twig', [
            'results' => $results,
        ]);
    }

    return $this->render('event/search.html.twig', [
        'form' => $form->createView(),
    ]);
}
#[Route('/', name: 'app_event_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,PaginatorInterface $paginator,Request $request): Response
    {   
        $searchTerm = $request->query->get('q');
        $event=[];
        if (!empty($searchTerm)) {
            $events = $entityManager
            ->getRepository(Events::class)
            ->findByTitre($searchTerm);
            $page = $paginator->paginate(
                $events,
                $request->query->getInt('page', 1),
                2
            );
            
        }
        else{
            $events = $entityManager
            ->getRepository(Events::class)
            ->findAll();
            $page = $paginator->paginate(
                $events,
                $request->query->getInt('page',1),
                2
            );
           
        }
        

        return $this->render('event/index.html.twig', [
            'page' => $page,
            'searchTerm' => $searchTerm,
        ]);
    }
    
}
