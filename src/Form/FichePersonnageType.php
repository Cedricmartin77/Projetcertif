<?php

namespace App\Form;

use App\Entity\FichePersonnage;
use App\Entity\EncyclopedieDuPersonnage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FichePersonnageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('img', FileType::class, [
            'required' => false,
            'label' => 'Logo du Personnage',
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
        ->add('encyclopediedupersonnage', EntityType::class, [
            'class' => EncyclopedieDuPersonnage::class,
            'choice_label' => 'title',
            'label' => 'Encyclopedie Du Personnage'
        ])
        ->add('title', TextType::class, [
            'label' => 'Nom du personnage',
            'required' => false,
            'attr' => [
                'placeholder' => 'Ex.: Vegeta - Super Saiyan',
            ]
        ])
        ->add('secondtitle', TextType::class, [
            'label' => 'Second nom du personnage',
            'required' => false,
            'attr' => [
                'placeholder' => 'Ex.: Le plus fort',
            ]
        ])
        ->add('aptitudeleader', TextareaType::class, [
            'label' => 'Aptitude Leader',
            'required' => false,
            'attr' => [
                'placeholder' => 'Ex.: Atk et def +170%'
            ]
        ])
        ->add('nompassiveskill', TextType::class, [
            'label' => 'Nom Passive Skill',
            'required' => false,
            'attr' => [
                'placeholder' => 'Ex.: Saiyan au coeur d\'or'
            ]
        ])
        ->add('descriptionpassiveskill', TextareaType::class, [
            'label' => 'Description Passive Skill',
            'required' => false,
            'attr' => [
                'placeholder' => 'Ex.: Bloque lennemie'
            ]
        ])
        ->add('nomattaquespecial', TextType::class, [
            'label' => 'Nom Attaque Spécial',
            'required' => false,
            'attr' => [
                'placeholder' => 'Ex.: Big Bang !'
            ]
        ])
        ->add('descriptionattaquespecial', TextareaType::class, [
            'label' => 'Description Attaque Spécial',
            'required' => false,
            'attr' => [
                'placeholder' => 'Ex.: Bloque lennemie'
            ]
        ])
            ->add('nomattaquespecialultime', TextType::class, [
                'label' => 'Nom Attaque Spécial Ultime',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: Big Bang !',
                ]
            ])
            ->add('descriptionattaquespecialultime', TextareaType::class, [
                'label' => 'Description Attaque Spécial Ultime',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: Bloque lennemie',
                ]
            ])
            ->add('nomunitsuperattaque', TextType::class, [
                'label' => 'Nom Unit Super Attaque',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: Big Bang !',
                ]
            ])
            ->add('descriptionunitsuperattaque', TextareaType::class, [
                'label' => 'Description Unit Super Attaque',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: Bloque lennemie',
                ]
            ])
            ->add('nomactiveskill', TextType::class, [
                'label' => 'Nom Active Skill',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: Saiyan au coeur d\'or',
                ]
            ])
            ->add('descriptionactiveskill', TextareaType::class, [
                'label' => 'Description Active Skill',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: Bloque lennemie',
                ]
            ])
            ->add('listedesliensdupersonnage', TextareaType::class, [
                'label' => 'Listes des Liens du Personnage',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: Super Saiyan - Guerrier Z ..'
                ]
            ])
            ->add('listedescategoriedupersonnage', TextareaType::class, [
                'label' => 'Listes des Catégories du Personnage',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: Tenkaichi Budokai - Super Saiyan..'
                ]
            ])
            ->add('hpdebase', IntegerType::class, [
                'label' => 'Point de vie de base',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 0
                ]
            ])
            ->add('attaquedebase', IntegerType::class, [
                'label' => 'Attaque de base',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 0
                ]
            ])
            ->add('defensedebase', IntegerType::class, [
                'label' => 'Défense de base',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 0
                ]
            ])
            ->add('hpmax', IntegerType::class, [
                'label' => 'Point de vie max',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 0
                ]
            ])
            ->add('attaquemax', IntegerType::class, [
                'label' => 'Attaque max',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 0
                ]
            ])
            ->add('defensemax', IntegerType::class, [
                'label' => 'Defense max',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 0
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FichePersonnage::class,
        ]);
    }
}
