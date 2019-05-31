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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;




class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder     
            ->add('name',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('model',TextType::class,['attr'=>['class'=>'form-control']] )
            ->add('price',NumberType::class,['attr'=>['class'=>'form-control']])
            ->add('description',TextareaType::class,['attr'=>['class'=>'materialize-textarea col-md-12']])   
            ->add('Color',ChoiceType::class,[
                'choices' =>
                array_combine(CarProvider::color,CarProvider::color),
                'attr'=>['class'=>'col-md-12']
                
                
            ])
            ->add('fuel',ChoiceType::class,[
                'choices' =>
                array_combine(CarProvider::carburant,CarProvider::carburant),
                'attr'=>['class'=>'col-md-12']
            ])
            ->add('image',ImageType::class,['label'=>false])

            ->add('keywords',CollectionType::class,['entry_type'=>KeywordType::class,
             'allow_add' =>true,
             'by_reference'=>false,
             'label'=>false,
           
             ])
            ->add('cities',EntityType::class,[
                'class'=> City::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>false,
                'attr'=>['class'=>'col s12']
                     ]);
            

        $builder->addEventListener( FormEvents::POST_SUBMIT,
        function (FormEvent $event) use ($options){

            $data = $event->getData();
         $fileSubmitted  =  $event->getForm()->get('image')->get('file')->getData();
          if($fileSubmitted == null) {
              $data->setImage(null);
              return;
          } 
          $image= $car->getImage();
          $image->setPath($options['path']);
          
        
        });

            
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
            'path' => null
            // 'my_model'=>null
        ]);
    }
}
