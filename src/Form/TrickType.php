<?php

namespace App\Form;

use App\Entity\Trick;
use App\Entity\GroupTrick;
use App\Form\ImageType;
use App\Form\VideoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('groupTrick', EntityType::class, [
                'class' => GroupTrick::class,
                'choice_label' => 'title'
                
            ]) 
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'label' => false,
                'allow_add' => true,
                'mapped' => false,
                'by_reference' => false,
                'allow_delete' => true,
               /*  'compound' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '5024k',
                        'accept' => 'image/*',
                        'mimeTypes' => [
                            'application/jpg',
                            'application/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid  document', 
                    ])
                ], */
            ])
            ->add('videos', CollectionType::class, [
                'entry_type' => VideoType::class,
                'label' => false,
                'allow_add' => true,
                'mapped' => false,
                'by_reference' => false,
                'allow_delete' => true,
            ])

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
