<?php

namespace App\Security\Voter;
use Symfony\Component\Security\Core\Security;
use App\Entity\Car;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CarVoter extends Voter
{

    
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    protected function supports($attribute, $subject)
    {

        return in_array($attribute, ['EDIT', 'delete'])
            && $subject instanceof \App\Entity\Car;
    }

    protected function voteOnAttribute($attribute, $car, TokenInterface $token)
    {
        $user = $token->getUser();


        if(null == $car->getUser()){
            return false;
        }
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'EDIT':
            if ($this->security->isGranted('ROLE_USER') ) {
                return $car->getUser()->getId() == $user->getId();
                break;   
            }
            case 'delete':
            if ($this->security->isGranted('ROLE_USER') ) {
                return $car->getUser()->getId() == $user->getId();
                break;
            }
        }

        return false;
    }
}
