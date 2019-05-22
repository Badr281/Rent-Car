<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\City;
use App\Entity\Keyword;
use App\Form\ImageType;
use App\Entity\Provider;
use App\Form\KeywordType;
use App\faker\CarProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[])
            ->add('model',TextType::class,[] )
            ->add('price',NumberType::class,[])
            ->add('Color',ChoiceType::class,[
                'choices' =>
                 array_combine(CarProvider::color,CarProvider::color)
            
            ])
            ->add('fuel',ChoiceType::class,[
                'choices' =>
                array_combine(CarProvider::carburant,CarProvider::carburant),
            ])
            ->add('image',ImageType::class,['label'=>false])

            ->add('keywords',CollectionType::class,['entry_type'=>KeywordType::class,
             'allow_add' =>true,
             'by_reference'=>false,
             'label'=>false])
            ->add('cities',EntityType::class,[
                'class'=> City::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>false,
                     ]);
    
            
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
            // 'my_model'=>null
        ]);
    }
}
