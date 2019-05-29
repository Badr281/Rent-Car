<?php

namespace App\Controller;
use App\Repository\CarRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class dashboardController extends AbstractController
{
    
    /**
     * @Route("/dashboard", name="dashboard")
     * 
     */
    public function dashboard(CarRepository $car)
    {
        return $this->render('library/dashboard.html.twig',[
            'cars'=>$this->getUser()->getCars($car)
        ]);
    }
}