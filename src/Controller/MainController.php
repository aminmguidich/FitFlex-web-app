<?php

namespace App\Controller;

use App\Repository\ActivitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(ActivitesRepository $activitesRepository)
    {
        $events = $activitesRepository->findAll();
        $categoryColors = [
            'Aquatique' => '#33A6FF', // Replace with actual colors or use a color library
            'Force' => '#FF334F',
            'Souplesse' => '#33FF7E',
            // Add more categories and colors as needed
        ];

        $rdvs = [];

        foreach($events as $event){
            $category = $event->getIdcategorie()->getCategorie(); // Assuming getName() returns the category name
            $backgroundColor = $categoryColors[$category] ?? '#CCCCCC'; // Default to a fallback color if category not found
            $rdvs[] = [
                'id' => $event->getCode(),
                'start' => $event->getDateDeb()->format('Y-m-d H:i:s'),
                'end' => $event->getDateFin()->format('Y-m-d H:i:s'),
                'title' => $event->getTitre(),
                //'description' => $event->getDescription(),
                'backgroundColor' => $backgroundColor,
                 'borderColor' => $backgroundColor,
                //'textColor' => $event->getTextColor(),
                //'allDay' => $event->getAllDay(),
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('main/index.html.twig', compact('data'));
    }
}
