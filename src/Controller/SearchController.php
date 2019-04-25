<?php
namespace App\Controller;
use App\Form\SearchType;
use App\Form\Search1Type;
use App\Repository\CarRepository;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController 
{

    // /**
    //  * @Route("search",name="search1")
    //  */
    // public function search(Request $request,CarRepository $carRepository){

    //     $form = $this->createForm(SearchType::class);
    //     $form->handleRequest($request);
    //     $car = [];
    //     if($form->isSubmitted() && $form->isValid() )
    //     {   
    //         $data = $form->getData();
          
    //         $car = $carRepository->searchCar($data);
        
             
    //     }
    //     return $this->render('test/search.html.twig',[
    //         'form'=> $form->createView(),
    //         'Car'=> $car
    //     ]);
    // }



    /**
     * @Route("search1",name="search1")
     */
    public function test(Request $request,BookRepository $BookRepository ){ 
       
        $form= $this->createForm(Search1Type::class);
        $form->handleRequest($request);
          $book=[];
        if($form->isSubmitted() && $form->isValid()){

            $data =$form->getData();
            $book =$BookRepository->search($data);
        }

        return $this->render('cours/search.html.twig',[
        'form' => $form->createView(),
        'books'=>$book

        ]);
    }




}

