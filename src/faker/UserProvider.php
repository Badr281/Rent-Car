<?php
namespace App\faker;

use App\Entity\User;
use Faker\Generator;
use Faker\Provider\Base;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserProvider extends Base
{
    private $userPasswordEncoder;
    public function __construct(Generator $generator, UserPasswordEncoderInterface $userPasswordEncoder){
        parent::__construct($generator);
        $this->userPasswordEncoder =$userPasswordEncoder;
    }
    public function encoderPassword($password){
        return $this->userPasswordEncoder->encodePassword(new User(),$password);
    }
}