<?php

namespace App\Form;

use App\Entity\User;
use App\Form\RolesType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class AdminType extends AbstractType
{
   
    const role_value = ['ROLE_USER','ROLE_ADMIN'];
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)
            ->add('roles', ChoiceType::class,[
                
                'choices'=>array_combine(self::role_value,self::role_value),
                'multiple'=>true
            ])
            ->add('password',TextType::class)
            ->add('modify',SubmitType::class,['attr'=>array('class'=>'form-control')])   
                ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    

    
    }
    
}
