<?php

namespace App\Controller;

use App\Repository\EquipementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(EquipementRepository $equipement): Response
    {
        
          $events = $equipement->findAll();
           foreach($events as $event){
            $rdvs[] = [
                'id' => $event->getIdEquipement(),
                'start' => $event->getDateAchat()->format('Y-m-d H:i:s'),
              
    
            ];
            
           }
    
           $data =json_encode($rdvs);
    
            return $this->render('main/index.html.twig', compact('data'));
        
        }
}
