<?php

namespace App\Controller;


use App\Entity\Car;
use App\Entity\City;
use App\Form\CarType;
use App\Form\BookType;
use App\Entity\Keyword;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\imageHandler;
use Symfony\Component\Security\Core\Security;



class LibraryController extends AbstractController
{

    private $security;
    public function __construct(Security $security){

        $this->security =  $security;
    }
    /**
     * @Route("/", name="library")
     */
    public function index(CarRepository $carRepository)
    {
       $car= $carRepository->findAll();

       $title =array("titre"=>"la chévre de monsieur sougain","title"=>"l'homme qui voulais étre heureux");
       $year =array("year"=>"2019","year"=>"2018");

        return $this->render('test/index1.html.twig',[
            'title'=>$title,
            'year'=> $year,
            'Car'=>$car,
           
            ]);
    }
	
    /**
     * @Route("/info/{title}",name="info")
     */
    public function information($title)
    {
        return $this->render('test/information.html.twig',[
            'title'=>$title,
      
        ]);

    }
    /**
     * @Route("/site/{year}",name="site")
     */
    public function information1($year)
    {
        return $this->render('test/information.html.twig',[
            'year'=>$year
        ]);
    }

     /**
     * @Route("/car/add",name="add")
     */
    public function Create(EntityManagerInterface $manager){
        // Dexiéme méthode pour récupérer ManagerDb
        // $manager = $this->getDoctrine()->getManager();
        $car =new Car();
        $car->setModel("2019");
        $car->setName("Dacia");
        $car->setprice("7000");
       
        // Create new car
        $Nissan =new Car();
        $Nissan->setModel("2019");
        $Nissan->setName("Nissan");
        $Nissan->setprice("17000");
        $manager->persist($car);
        $manager->persist($Nissan);
        $manager->flush();


   
        return $this->render('library/add.html.twig');
    }
    /**
     * @Route("/car/show/{id}",name="show")
     */
    public function show(Car $car)
    {   
      
        return $this->render('test/show.html.twig',[
            'Car'=>$car,     
        ]);
    }

    /**
     * @Route("car/delete/{id}",name="remove")
     */
    public function remove(Car $car,EntityManagerInterface $manager)
    {   
        if ($this->security->isGranted('ROLE_USER') ) {
            $this->denyAccessUnlessGranted('delete',$car);
         }    
        $manager->remove($car);
        $manager->flush();
        $this->addFlash('notice',
        "La voiture a été bien suprimé !");
        return $this->redirectToRoute('library');
        
    }
    // Add a new car using services or event inside entity

     /**
     * @Route("/car/ajouter",name="add1")
     */
    public function add(EntityManagerInterface $manager,Request $request,ValidatorInterface $validator)
    {   
        
        $path = $this->getParameter('kernel.project_dir').'\public\pic' ; 
        $form = $this->createForm(CarType::Class,null,['path'=>$path]);
        $form->handleRequest($request);
       

        if($form->isSubmitted() && $form->isValid() ){
       
        $cardata =  $form->getData();
        // $image = $cardata->getImage();    
        // $image->setPath($path);
        $user = $this->getUser();
        $cardata->setUser($user);
            // naviguer avec la référence de l'entité
            // $file = $image->getFile();
            // $name = md5(uniqid()).'.'.$file->guessExtension();
            // // deplacer le fichier
            // $file->move($path,$name);
            // $image->setName($name);
            //  $imageHandler->handle($image,$path);  
            
            $errors = $validator->validate($cardata);
                if (count($errors) > 0) {
                    $errorsString = (string) $errors;
                    return new Response($errorsString);
                }

            $manager->persist($cardata);
            $manager->flush();
            $this->addFlash(
                'notice',
                'Votre voiture a été bien enregistré. '
            );
          return $this->redirectToRoute('library');
        }
      
        return $this->render('library/add.html.twig',[
                'form'=>$form->createView()
        ]);
    }
  
    /**
     * @Route("car/edit3/{id}",name="edit3")
     */
    public function edit(Car $car,EntityManagerInterface $manager,Request $request,ValidatorInterface $validator){
        if ($this->security->isGranted('ROLE_USER') ) {
        $this->denyAccessUnlessGranted('EDIT',$car);
        }


        $path = $this->getParameter('kernel.project_dir').'\public\pic' ; 
        $form = $this->createForm(CarType::Class,$car,['path'=>$path]);
        $form->handleRequest($request);
      

        if($form->isSubmitted() && $form->isValid() ){ 
        
           
            $datacar = $form->getData();
        
            $user = $this->getUser();
            $datacar->setUser($user);
            $manager->flush();
            $this->addflash(
                'notice',
                'modification compléte avec succés'
            );

            return $this->redirectToRoute('library');


        }
        return $this->render('library/edit.html.twig',[
            'form'=>$form->createView(),
            'Car'=>$car

        ]);
    }
    // ---------------- traditional method add --------------
    // /**
    //  * @Route("add4",name="add4")
    //  */
    // public function add1(EntityManagerInterface $manager ,Request $request){
        
    //      $form=$this->createForm(BookType::class);
    //      $form->handleRequest($request);
    //      $car1 = new Car();
    //      $car1->setName("Volvo");
    //      $car1->setModel("2023");
    //      $car1->setPrice(2000);
    //      $city = new City();
    //      $city->setName('rabat');   
    //      $car1->addCity($city);
    //      $manager->persist($car1);
    //      $manager->flush();
    //      if($form->isSubmitted() && $form->isValid()){
    //        $path = $this->getParameter('kernel.project_dir').'public/pic' ;
    //        $book= $form->getData();    
    //        $image =$book->getImage();
    //        $file= $image->getFile();
    //        $name = md5(uniqid()).'.'.$file->guessExtension();
    //        $image->setName($name);
  
    //         $file->move($path,$name);

                


    //         $manager->persist($book);
    //         $manager->flush();  
    //         return $this->redirectToRoute('test/library.html.twig');
    //      }

    //     return $this->render('first/addb.html.twig',[
    //          'form'=>$form->createView()
    //     ]);
    // }

    
    
}
