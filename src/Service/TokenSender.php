<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Token;

class TokenSender 
{
private $twig;
private $mailer;
public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig )
{
    $this->twig= $twig;
    $this->mailer =$mailer;
}


public function sendToken(User $user,Token $token)
{
    $message = ( new \Swift_Message("veuillez confirmer l'inscription"))
    ->setFrom('morad28138@gmail.com')
    ->setTo($user->getEmail())
    ->setBody(
        $this->twig->render('emails/register.html.twig',['token'=>$token->getValue()]),
        'text/html'
    );
    return $this->mailer->send($message);
}


}