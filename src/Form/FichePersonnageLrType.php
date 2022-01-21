<?php

namespace App\Form;

use App\Entity\FichePersonnageLr;
use App\Entity\EncyclopedieDuPersonnage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FichePersonnageLrType extends AbstractType
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
                    'maxSize' => '10M',
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
        ->add('encyclopediedupersonnage', EntityType::class, [
            'class' => EncyclopedieDuPersonnage::class,
            'choice_label' => 'title',
            'label' => 'Encyclopedie Du Personnage'
        ])
        ->add('aptitudeleader', TextareaType::class, [
            'label' => 'Aptitude Leader',
            'attr' => [
                'placeholder' => 'Ex.: Atk et def +170%'
            ]
        ])
        ->add('nomattaquespecial', TextType::class, [
            'label' => 'Nom Attaque Spécial',
            'attr' => [
                'placeholder' => 'Ex.: Big Bang !'
            ]
        ])
        ->add('descriptionattaquespecial', TextareaType::class, [
            'label' => 'Description Attaque Spécial',
            'attr' => [
                'placeholder' => 'Ex.: Bloque lennemie'
            ]
        ])
            ->add('nomattaquespecialultime', TextType::class, [
                'label' => 'Nom Attaque Spécial Ultime',
                'attr' => [
                    'placeholder' => 'Ex.: Ultra Kamehameha'
                ]
            ])
            ->add('descriptionattaquespecialultime', TextareaType::class, [
                'label' => 'Description Attaque Spécial Ultime',
                'attr' => [
                    'placeholder' => 'Ex.: Reduit la def ennemie de 10%'
                ]
            ])
            ->add('nompassiveskill', TextType::class, [
                'label' => 'Nom Aptitude Passive',
                'attr' => [
                    'placeholder' => 'Ex.: Saiyan au coeur d\'or'
                ]
            ])
            ->add('descriptionpassiveskill', TextareaType::class, [
                'label' => 'Description Aptitude Passive',
                'attr' => [
                    'placeholder' => 'Ex.: Bloque lennemie'
                ]
            ])
            ->add('listedesliensdupersonnage', TextareaType::class, [
                'label' => 'Listes des Liens du Personnage',
                'attr' => [
                    'placeholder' => 'Ex.: Super Saiyan - Guerrier Z ..'
                ]
            ])
            ->add('listedescategoriesdupersonnage', TextareaType::class, [
                'label' => 'Listes des Catégories du Personnage',
                'attr' => [
                    'placeholder' => 'Ex.: Tenkaichi Budokai - Super Saiyan..'
                ]
            ])
            ->add('hpdebase')
            ->add('attaquedebase')
            ->add('defensedebase')
            ->add('hpmax')
            ->add('attaquemax')
            ->add('defensemax')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FichePersonnageLr::class,
        ]);
    }
}
