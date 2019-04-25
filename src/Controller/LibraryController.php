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

class LibraryController extends AbstractController
{
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
            'Car'=>$car
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
     * @Route("add",name="add")
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
     * @Route("show/{id}",name="show")
     */
    public function show(Car $car)
    {   
      
        return $this->render('test/show.html.twig',[
            'Car'=>$car,     
        ]);
    }
    /**
     * @Route("edit/{id}",name="edit1")
     */
    public function edit1(Car $car,EntityManagerInterface $manager)
    {   $form = $this->createForm(CarType::Class,$car,['my_model'=>'clio']);
        $car->setModel("bugatti");
        $manager->flush($car);
        return $this->render('test/show.html.twig',[
            'Car'=>$car
            
            
        ]);
    }

     /**
     * @Route("edit/{id}",name="edit")
     */
    public function edit(Car $car,EntityManagerInterface $manager)
    {   
        $manager->remove($car);
        $manager->flush();
        return $this->redirectToRoute('library');
        
    }
    /**
     * @Route("delete/{id}",name="remove")
     */
    public function remove(Car $car,EntityManagerInterface $manager)
    {   
        $manager->remove($car);
        $manager->flush();
        return $this->redirectToRoute('library');
        
    }
     /**
     * @Route("/ajouter",name="add1")
     */
    public function add(EntityManagerInterface $manager,Request $request,ValidatorInterface $validator)
    {
        $form = $this->createForm(CarType::Class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            $path = $this->getParameter('kernel.project_dir').'public/pic' ;
            $car = $form->getData();     
            $image= $car->getImage();
            // naviguer avec la référence de l'entité
            $file = $image->getFile();
            $name = md5(uniqid()).'.'.$file->guessExtension();
            // deplacer le fichier
            $file->move($path,$name);
            $image->setName($name);
            $errors = $validator->validate($car);
                if (count($errors) > 0) {
                    $errorsString = (string) $errors;
                    return new Response($errorsString);
                }

            $manager->persist($car);
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
     * @Route("modifier/{id}",name="edit2")
     */
    public function edit2(EntityManagerInterface $manager,Car $car,Request $request)
    {
        $form = $this->createForm(CarType::Class,$car);
        $form->handleRequest($request);     
        if($form->isSubmitted() && $form->isValid()){
            
            $manager->flush();
            $this->addFlash(
                'notice',
                'modification compléte'
            );
          return  $this->redirectToRoute('library');
        }
        return $this->render('library/edit.html.twig',[
                'form'=>$form->createView(),
                'car'=>$car
        ]);
    }
    /**
     * @Route("/edit3/{id}",name="edit3")
     */
    public function edit3(Car $car,EntityManagerInterface $manager,Request $request){
        $form = $this->createForm(CarType::Class,$car);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() ){
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
    /**
     * @Route("add4",name="add4")
     */
    public function add1(EntityManagerInterface $manager ,Request $request){
        
         $form=$this->createForm(BookType::class);
         $form->handleRequest($request);
         $car1 = new Car();
         $car1->setName("Volvo");
         $car1->setModel("2023");
         $car1->setPrice(2000);
         $city = new City();
         $city->setName('rabat');   
         $car1->addCity($city);
         $manager->persist($car1);
         $manager->flush();
         if($form->isSubmitted() && $form->isValid()){
           $path = $this->getParameter('kernel.project_dir').'public/pic' ;
           $book= $form->getData();     
           $image =$book->getImage();
           $file= $image->getFile();
           $name = md5(uniqid()).'.'.$file->guessExtension();
           $image->setName($name);
  
            $file->move($path,$name);

                


            $manager->persist($book);
            $manager->flush();  
            return $this->redirectToRoute('test/library.html.twig');
         }

        return $this->render('first/addb.html.twig',[
             'form'=>$form->createView()
        ]);
    }

     /**
     * @Route("add5",name="add5")
     */
    public function add2(Type $var = null)
    {
       

     }
    
}
