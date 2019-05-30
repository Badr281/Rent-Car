<?php

namespace App\Service;


use App\Entity\Token;
use App\Repository\UserRepository;

class deleteUser 
{
private $twig;
private $mailer;
public function __construct( \Twig_Environment $twig )
{
    $this->twig= $twig;

}


public function sendToken(Token $token,UserRepository $UserRepository)
{
$user = $UserRepository->findAll();
$this->twig->render('admin/index.html.twig',['token'=>$token->getValue(),$user]);
}


}