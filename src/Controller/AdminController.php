<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    // affecter le role SuperUtilisateur a travers @Security annotation 
    // ou par le fichier security.yaml
     
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }
   
}
