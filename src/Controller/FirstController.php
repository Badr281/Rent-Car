<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Michelf\MarkdownInterface;
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
    public function index(MarkdownInterface  $markdown){
        $productContent = <<<EOF
        Spicy **jalapeno bacon** ipsum dolor amet veniam<strong>ecdc</strong> shank in dolore. Ham hock nisi landjaeger cow,
        lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
        labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
        turkey shank eu pork belly meatball non cupim.
        Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
        laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
        capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
        picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
        occaecat lorem meatball prosciutto quis strip steak.
        Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
        mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
        strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
        cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
        fugiat.     
EOF;
            $productContent = $markdown->transform($productContent);
       return $this->render('first/index.html.twig',['productContent'=>$productContent]);

        

    }
     /**
     * @Route("/Accueil/{cc}",name="Accueil")
     */
    public function test1($cc){
        $table =[
            'angular',
            'react',
            'vue',
            'mobile',
            'motivation',
        ];
        return $this->render('test/number.html.twig',['slug'=>$cc,'id'=>$table]);

    }

     /**
     * @Route("/language/{choice}",name="lang")
     */
    public function show($choice)
    {
        return $this->render('first/show.html.twig',[
            'choice'=>$choice
        ]);
    }
    /**
     * @Route("/inde",name="home")
     */
    public function index1()
    {
      return $this->render('test/index1.html.twig');
    }



}