<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface


{
private $entityManager;

public function __construct(EntityManagerInterface $entityManager){

    $this->entityManager = $entityManager;
}

public function loadUserByUsername($email)
{
   return $this->entityManager->createQueryBuilder('u')
   ->where('u.email = :email')
   ->setParameter('email',$email)
   ->getQuery()
   ->getOneOrNullResult();
}


// refresh user

public function refreshUser(UserInterface $user)
{
   if(!$user instanceOf User){
    throw new UnsupportedUserException(
        sprintf('Instances of "%s" are not supported.', get_class($user))
    );
   }
}

public function supportsClass($class)
{
    return $class === 'App\Security\User';
}

}
