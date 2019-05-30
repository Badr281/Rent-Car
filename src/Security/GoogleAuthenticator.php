<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use Symfony\Component\HttpFoundation\RedirectResponse;
class GoogleAuthenticator extends SocialAuthenticator
{
private $clientRegistry;
private $em;
private $router;
private $urlGenerator;
public  function __construct(EntityManagerInterface $em,ClientRegistry $clientRegistry,RouterInterface $router,UrlGeneratorInterface $urlGenerator){
    $this->em = $em;
    $this->clientRegistry = $clientRegistry;
    $this->router = $router;
    $this->urlGenerator = $urlGenerator;
}
public function supports(Request $request)
{
    return $request->getPathInfo() == '/connect/google/check' && $request->isMethod('GET');
}
public function getCredentials(Request $request)
{
    return $this->fetchAccessToken($this->getGoogleClient());
}
public function getUser($credentials, UserProviderInterface $userProvider)
{
    $googleUser = $this->getGoogleClient()
        ->fetchUserFromToken($credentials);
    $email = $googleUser->getEmail();
    
    $user = $this->em->getRepository('App:User')
        ->findOneBy(['email' => $email,'enable'=>true]);
    // $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email,'enable'=>true ]);    
    if (!$user) {
        return $user;
        // persist a new user
        // $user = new User();
        // $user->setEmail($googleUser->getEmail());
        // $user->setFullname($googleUser->getName());
        // $uatedAt(neser->setCrew \DateTime(date('Y-m-d H:i:s')));
        // $this->em->persist($user);
        // $this->em->flush();
    }
    else if($user)
   { 
       return $user;
    }
}
/**
 * @return \KnpU\OAuth2ClientBundle\Client\OAuth2Client
 */
private function getGoogleClient()
{
    return $this->clientRegistry
        ->getClient('google');
}
public function start(Request $request, \Symfony\Component\Security\Core\Exception\AuthenticationException $authException = null)
{
    return new RedirectResponse($this->urlGenerator->generate('app_login'));
}
public function onAuthenticationFailure(Request $request, \Symfony\Component\Security\Core\Exception\AuthenticationException $exception)
{
    return new RedirectResponse($this->urlGenerator->generate('register'));
}
public function onAuthenticationSuccess(Request $request, \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token, $providerKey)
{
    return new RedirectResponse($this->urlGenerator->generate('library'));
}
}

