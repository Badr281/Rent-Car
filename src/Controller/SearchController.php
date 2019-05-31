<?php
namespace App\Controller;
use App\Entity\Keyword;
use App\Form\SearchType;
use App\Form\Search1Type;
use App\Repository\CarRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SearchController extends AbstractController 
{

    /**
     * @Route("/car/search",name="search1")
     */
    public function search(Request $request,CarRepository $carRepository){

        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        $car = [];
        if($form->isSubmitted() && $form->isValid() )
        {   
            $data = $form->getData();
          
            $car = $carRepository->searchCar($data);
        
             
        }
        return $this->render('test/search.html.twig',[
            'form'=> $form->createView(),
            'Car'=> $car
        ]);
    }


// practice search method on another entity 

    /**
     * @Route("/car/search1",name="search2")
     */
    public function test(Request $request,BookRepository $BookRepository ){ 
       
        $form= $this->createForm(Search1Type::class);
        $form->handleRequest($request);
          $book=[];
        if($form->isSubmitted() && $form->isValid()){

            $data =$form->getData();
            $book =$BookRepository->searchbook($data);
          
        }

        return $this->render('cours/search.html.twig',[
        'form' => $form->createView(),
        'books'=>$book,


        ]);
    }
    /**
     * @Route("/search/deleteKeyword/{id}", name="deleteKeywords", methods = {"POST"} ,defaults={"id"=63},
     * condition="request.headers.get('X-Requested-With') matches '/XMLHttpRequest/i'"
     * )
     */
    public function deleteky(Keyword $keyword1,EntityManagerInterface $EntityManager ){ 
        
            $EntityManager->remove($keyword1);
            $EntityManager->flush();   
            return new JsonResponse();
    }




}

