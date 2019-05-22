<?php

namespace App\Controller;




use App\Entity\Car;
use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourController extends AbstractController
{

 /**
  * @Route("/c", name="display")
  */
public function index(PersonneRepository $repo )
{
    $personne= $repo->findAll();

    return $this->render('cours/index.html.twig',[
        'personnes'=>$personne
    ]);
}

  /**
  * @Route("ping/{id}", name="ping")
  */
public function show(PersonneRepository $personnerep,$id){
    $personne =$personnerep->find($id);

 
    return $this->render('cours/home.html.twig',[
          'personne'=>$personne
    ]);
    }
 /**
  * @Route("/cours1", name="cours")
  */
  public function filter(PersonneRepository $repo )
  {
      $personne= $repo->findAll();

      return $this->render('cours/index.html.twig',[
          'personnes'=>$personne
      ]);

  }
  public function add(EntityManagerInterface $manager)
  {
      return $this->render('');
  }


}