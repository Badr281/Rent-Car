<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class FirstController extends AbstractController
{
    
     /**
     * @Route("/d/cgi", name="article_show")
     */   
    public function test(){
    return $this->render('first/index.html.twig',[
        'controller_name'=>'-1'
    ]);
    }
    /**
     * @Route("/Accueil/{slug}",name="Accueil")
     */
    public function test1($slug){
        return $this->render('test/number.html.twig',['slug'=>$slug]);

    }
   /**
    * @Route("home",name="tests")
    */
    public function d(){

    $number = random_int(0, 100);


    return new Response(
        
        '<html><body>Lucky number: '.$number.'</body></html>'
    );
 
    }
    
  /**
     * @Route("/index",name="index")
     */
    public function index(MarkdownParserInterface  $markdown){
        $productContent = <<<EOF
        Le faux-texte également appelé lorem ipsum, lipsum, ou bolo bolo) est,[Click here](https://wwww.google.com/) en imprimerie, un texte sans signification, dont le seul objectif est de calibrer le contenu
EOF;
       $productContent =$markdown->transform($productContent);
     
       return $this->render('first/index.html.twig',['product'=>$productContent]);
        

    }

}