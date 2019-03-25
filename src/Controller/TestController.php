<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{
 
//     // /**
//     //  * @Route("/T/T2", name="test")
//     //  */
//     /**
//      * @Route("index")
//      */
//     public function index()
//     {
//         return $this->render('test/index.html.twig', [
//             'controller_name' => 'TestController',
//         ]);
//     }
   
//      /**
//      * @Route("/T",  methods={"GET","HEAD"})
//      */
//   public function lestTest(){

//         $response = new Response();

//         $response->setContent('<html><body><h1>Hello worldd!</h1></body></html>');
//         $response->setStatusCode(Response::HTTP_OK);

//         // sets a HTTP response header
//         $response->headers->set('Content-Type', 'text/html');

//             // prints the HTTP headers followed by the content
//         return   $response->send();
//      }
//      /**
//       * @Route("/B",name="e")
//       */
// public function number() {
// //     $nb = 100;
// //     for($i = 2; $i <= $nb; $i++) {
// //    echo $i;
// //    return new Response('<html><body>Le nombre premier est : '.$i.'</body></html>');
// //     }

//   for($i = 2; $i<=100;){
//     $premier = 1;
//     for($loop = 2; $loop<=$i; $loop++) {
//        if(($i % $loop) == 0 && $loop!=$i) {
//           $premier = 0;
//        }
//     }
//     if ($premier != 0){
//      echo "le nombre premier est : ".$i." <br>";
//        $i++;
//     }
//     else
//     $i ++;
//  }
//   return new Response('<html><body>Le nombre premier est : '.$premier.'</body></html>');
// }
    
//      /**
//      * @Route("/home/{age}/{name}", name="test")
//      */
//     public function home($age,$name){

//        return $this->render('test/number.html.twig',[
//         'age'=> $age,
//         'name' => $name
//        ]);
//     }

}