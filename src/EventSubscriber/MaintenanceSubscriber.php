<?php

namespace App\EventSubscriber;


use App\Entity\Car;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MaintenanceSubscriber implements  EventSubscriberInterface
{
  private $twig;
  public function __construct(\Twig_Environment $twig){

      $this->twig = $twig;
  }

    public function  ResponseMethod(FilterResponseEvent $event)
    {
      if(!$_SERVER['MAINTENANCE'])
      {
      $content = $this->twig->render('Maintenance/maintenance.html.twig');  

      $response = new Response($content);
     
      return  $event->setResponse($response);
    
      }
  
    }
    public static function getSubscribedEvents(){

        return [
         KernelEvents::RESPONSE=> ['ResponseMethod',255]
        ];
    }

}
