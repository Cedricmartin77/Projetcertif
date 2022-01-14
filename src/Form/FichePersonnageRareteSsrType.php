<?php

namespace App\Form;


use App\Entity\EncyclopedieDuPersonnage;
use App\Entity\FichePersonnageRareteSsr;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FichePersonnageRareteSsrType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('img', FileType::class, [
            'required' => false,
            'label' => 'Artwork du Personnage SSR',
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
                    'mimeTypesMessage' => 'Merci de sélectionner une iamge au format PNG, JPG, JPEG ou JP2'
                ])
            ]
        ])
        ->add('descriptionleaderskill', TextareaType::class, [
            'label' => 'Description Leader Skil',
            'attr' => [
                'placeholder' => 'Ex.: Ki +3, ATT, PV et DÉF +170 % pour la Catégorie - Guerriers de l\'au-delà ou
                Ki +3, ATT, PV et DÉF +150 % pour la Catégorie - Super Saiyan 3 '
            ]
        ])
        ->add('nomsuperattaque', TextType::class, [
            'label' => 'Nom Super Attaque',
            'attr' => [
                'placeholder' => 'Ex.: Super Kamehameha'
            ]
        ])
            ->add('descriptionsuperattaque', TextareaType::class, [
                'label' => 'Description Super Attaque',
                'attr' => [
                    'placeholder' => 'Ex.: Augmente l\'ATQ pendant 1 tour et inflige des dégâts immenses '
                ]
            ])
            ->add('nompassiveskill', TextType::class, [
                'label' => 'Nom Passive Skill',
                'attr' => [
                    'placeholder' => 'Ex.: Longue années d\'entraînement '
                ]
            ])
            ->add('descriptionpassiveskill', TextareaType::class, [
                'label' => 'Description Passive Skill',
                'attr' => [
                    'placeholder' => 'Ex.: ATT et DÉF +80%, plus les PV restants sont élevés, plus la DÉF augmente (max. 40 %), plus les PV restants sont bas, plus l\'ATT augmente (max. +40 %)'
                ]
            ])
            ->add('listedesliensdupersonnages', TextareaType::class, [
                'label' => 'Listes des Liens du Personnage',
                'attr' => [
                    'placeholder' => 'Ex.: Race Saiyan - Super Saiyan - Guerrier doré - Kamehameha (etc..)'
                ]
            ])
            ->add('listesdescategoriesdupersonnage', TextareaType::class, [
                'label' => 'Listes des Catégorie du Personnage',
                'attr' => [
                    'placeholder' => 'Ex.: Saga de Boo - Ressucité - Saiyan Pur - Famille de Son Goku (etc..)'
                ]
            ])
            ->add('encyclopediedupersonnage', EntityType::class, [
                'class' => EncyclopedieDuPersonnage::class,
                'choice_label' => 'title',
                'multiple' => 'true'
            ])
            ->add('hpdebase', IntegerType::class, [
                'label' => 'Hp de Base',
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 1
                ]
            ])
            ->add('attaquedebase', IntegerType::class, [
                'label' => 'Attaque de Base',
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 1
                ]
            ])
            ->add('defensedebase', IntegerType::class, [
                'label' => 'Defense de Base',
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 1
                ]
            ])
            ->add('hpmax', IntegerType::class, [
                'label' => 'Hp Max',
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 1
                ]
            ])
            ->add('attaquemax', IntegerType::class, [
                'label' => 'Attaque Max',
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 1
                ]
            ])
            ->add('defensemax', IntegerType::class, [
                'label' => 'Defense Max',
                'attr' => [
                    'placeholder' => 'Ex.: 8',
                    'min' => 1
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FichePersonnageRareteSsr::class,
        ]);
    }
}
