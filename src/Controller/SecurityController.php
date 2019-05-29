<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Token;
use App\Service\TokenSender;
use App\Form\RegistrationType;
use App\Repository\TokenRepository;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     * 
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }


     /**
     * @Route("/Register",name="register")
     */
    public function registration(Request $request,EntityManagerInterface $manager,GuardAuthenticatorHandler $guardHandler,LoginFormAuthenticator $LoginFormAuthenticator,
    UserPasswordEncoderInterface $encodePassword,TokenSender $TokenSender){
        
        $user = new User;
        $form = $this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
        // - encodage de password en utilisant UserPasswordEncoderInterface servic
        // - get formToken 
        // - $token3 = $request->get($form->getName())['_token'];
           $userPassword = $encodePassword->encodePassword($user,$user->getPassword());
           $user->setPassword($userPassword);
           $user->setRoles(['ROLE_ADMIN']);  
           // La création de d'utilisateur avec l'envoie d'email a travers le service TokenSender
           $token = new Token($user); 
        
   
           $manager->persist($token);   
        //    dd($token);
           $manager->flush(); 
         
           // l'envoie d'email 
           $TokenSender->sendToken($user,$token);
           // flash message
           $this->addFlash('notice',
           "un email de confirmation vous a été envoyé,veuillez cliquer le lien ci-dessus"
        );
           return $this->redirectToRoute('library');
           
        }

        return $this->render('admin/register.html.twig',[
         'form' => $form->createView()]);
    }
        /**
         * @Route("/confirmation/{value}",name="token_validation")
         */
        public function validate(Token $token,EntityManagerInterface $manager,GuardAuthenticatorHandler $guardHandler,LoginFormAuthenticator $LoginFormAuthenticator,
            Request $request ){
                
            $user =$token->getUser();
        
            if($user->getEnable() === true){
                    $this->addFlash('notice',
                    "Le compte est déja vérifiée"
                );
                return $this->redirectToRoute('library');
            }
           

            if ($token->isValid()) {
                $user->setEnable(true);
                $manager->flush();
                $guardHandler->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $LoginFormAuthenticator,
                    'main'
                );
                $this->addFlash('notice', "Compte vérifé");
                return $this->redirectToRoute('library');         
               

            }
            $manager->remove($token);
            $manager->remove($user);
            $manager->flush();
            $this->addFlash('notice', "Le token est expiré , Inscriver vous à nouveau");

            return $this->redirectToRoute('register');
        }

}
