<?php

namespace App\Form;


use App\Entity\City;
use App\faker\CarProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType
{
    const min_price = ['100','300','500','1000'];
    const max_price = ['100','300','500','1000'];
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('color',ChoiceType::class,[
                'choices' =>
                 array_combine(CarProvider::color,CarProvider::color)  
            ])
            ->add('fuel',ChoiceType::class,[
                'choices' =>
                array_combine(CarProvider::carburant,CarProvider::carburant),
            ])
            ->add('city',EntityType::class,[
                'class'=> City::class,
                'choice_label'=>'name',
                     
                     ])

            ->add('min_price',ChoiceType::class,[
                'label'=> 'prix minimal',
                'choices' =>array_combine(self::min_price,self::min_price),
            ])
            ->add('max_price',choiceType::class,[
                'label'=> 'prix maximale',
                'choices' =>array_combine(self::max_price,self::max_price),
            ])
            ->add('search',SubmitType::class,['attr'=>['class'=>'btn btn-primary form-control']])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
