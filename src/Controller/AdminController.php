<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Token;
use App\Form\AdminType;
use App\Service\deleteUser;
use App\Repository\UserRepository;
use App\Repository\TokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



class AdminController extends AbstractController
{
   
    // affecter le role SuperUtilisateur a travers @Security annotation 
    // ou par le fichier security.yaml

    /**
     * @Route("/super", name="super")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index(UserRepository $UserRepository,TokenRepository $TokenRepository)
    {
        $user = $UserRepository->findAll();
        $token = $TokenRepository->findAll();
        return $this->render('admin/index.html.twig',[
            'users'=> $user,
            'token'=>$token

           
        ]);
    }
    /**
     * @Route("super/delete1/{value}",name="deleteAa",defaults={"id"=3},methods={"GET"} )
     * @ParamConverter("token", options={"id" = "value"})
     */
    public function deleleAdmin(Token $token, EntityManagerInterface $manager,UserRepository $userRepository,Request $request){
        
        $user = $token->getUser();
        if(!$user == null)
  {    
        $manager->remove($token);
        $manager->remove($user);
        $manager->flush();
        $this->addFlash('notice',"La suppression est bien fait");
    }
    
       return $this->render('admin/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
    
    /**
     * @Route("admin/edit/{id}",name="editA")
     */
    public function Edit(User $user,EntityManagerInterface $manager,Request $request){
      
        $form = $this->createForm(AdminType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        { 
            $manager->flush();
            $this->addFlash('notice',"La modification est bien fait");
            return $this->redirectToRoute('library');
        }

        return $this->render('admin/edit.html.twig',
        [
            'form' => $form->createView(),        
        ]);
    }
   
   
}
