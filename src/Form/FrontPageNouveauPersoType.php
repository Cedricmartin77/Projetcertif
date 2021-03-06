<?php

namespace App\Form;

use App\Entity\FichePersonnage;
use App\Entity\FrontPageNouveauPerso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FrontPageNouveauPersoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('img', FileType::class, [
            'required' => false,
            'label' => 'Artwork du Personnage',
            'mapped' => false,
            'help' => 'png, jpg, jpeg ou jp2 - 1 Mo maximum',
            'constraints' => [
                new Image([
                    'maxSize' => '400M',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                        'image/jp2',
                        'image/webp',
                        'image/svg',
                        'image/gif'
                    ],
                    'mimeTypesMessage' => 'Merci de sélectionner une iamge au format PNG, JPG, JPEG ou JP2'
                ])
            ]
        ])
        ->add('fichepersonnage', EntityType::class, [
            'class' => FichePersonnage::class,
            'choice_label' => 'id',
            'label' => 'Id Fiche Personnage',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FrontPageNouveauPerso::class,
        ]);
    }
}
