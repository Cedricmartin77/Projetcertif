<?php

namespace App\Form;

use App\Entity\FrontPageNouveauPersos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FrontPageNouveauPersosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('img1', FileType::class, [
            'required' => false,
            'label' => 'Logo du Personnage',
            'mapped' => false,
            'help' => 'png, jpg, jpeg ou jp2 - 1 Mo maximum',
            'constraints' => [
                new Image([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                        'image/jp2',
                        'image/webp',
                        'image/svg',
                        'image/gif'
                    ],
                    'mimeTypesMessage' => 'Merci de sélectionner une image au format PNG, JPG, JPEG ou JP2'
                ])
            ]
        ])
        ->add('img2', FileType::class, [
            'required' => false,
            'label' => 'Logo du Personnage',
            'mapped' => false,
            'help' => 'png, jpg, jpeg ou jp2 - 1 Mo maximum',
            'constraints' => [
                new Image([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                        'image/jp2',
                        'image/webp',
                        'image/svg',
                        'image/gif'
                    ],
                    'mimeTypesMessage' => 'Merci de sélectionner une image au format PNG, JPG, JPEG ou JP2'
                ])
            ]
        ])
        ->add('img3', FileType::class, [
            'required' => false,
            'label' => 'Logo du Personnage',
            'mapped' => false,
            'help' => 'png, jpg, jpeg ou jp2 - 1 Mo maximum',
            'constraints' => [
                new Image([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                        'image/jp2',
                        'image/webp',
                        'image/svg',
                        'image/gif'
                    ],
                    'mimeTypesMessage' => 'Merci de sélectionner une image au format PNG, JPG, JPEG ou JP2'
                ])
            ]
        ])
        ->add('img4', FileType::class, [
            'required' => false,
            'label' => 'Logo du Personnage',
            'mapped' => false,
            'help' => 'png, jpg, jpeg ou jp2 - 1 Mo maximum',
            'constraints' => [
                new Image([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                        'image/jp2',
                        'image/webp',
                        'image/svg',
                        'image/gif'
                    ],
                    'mimeTypesMessage' => 'Merci de sélectionner une image au format PNG, JPG, JPEG ou JP2'
                ])
            ]
        ])
        ->add('img5', FileType::class, [
            'required' => false,
            'label' => 'Logo du Personnage',
            'mapped' => false,
            'help' => 'png, jpg, jpeg ou jp2 - 1 Mo maximum',
            'constraints' => [
                new Image([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                        'image/jp2',
                        'image/webp',
                        'image/svg',
                        'image/gif'
                    ],
                    'mimeTypesMessage' => 'Merci de sélectionner une image au format PNG, JPG, JPEG ou JP2'
                ])
            ]
        ])
        ->add('img6', FileType::class, [
            'required' => false,
            'label' => 'Logo du Personnage',
            'mapped' => false,
            'help' => 'png, jpg, jpeg ou jp2 - 1 Mo maximum',
            'constraints' => [
                new Image([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                        'image/jp2',
                        'image/webp',
                        'image/svg',
                        'image/gif'
                    ],
                    'mimeTypesMessage' => 'Merci de sélectionner une image au format PNG, JPG, JPEG ou JP2'
                ])
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FrontPageNouveauPersos::class,
        ]);
    }
}
