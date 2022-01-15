<?php

namespace App\Form;

use App\Entity\EncyclopedieDuPersonnage;
use App\Entity\FichePersonnageRareteSsr;
use Symfony\Component\Form\AbstractType;
use App\Entity\EncyclopedieDesPersonnages;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FichePersonnageRareteSsrType extends AbstractType
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
        ->add('encyclopediedupersonnage', null, [
            'class' => EncyclopedieDuPersonnage::class,
            'choice_label' => 'title'
        ])
            ->add('descriptionaptitudeleader', TextareaType::class, [
                'label' => 'Description Leader Skill',
                'attr' => [
                    'placeholder' => 'Ex.: Kakemehameha + 170%'
                ]
            ])
            ->add('nomsuperattaque', TextType::class, [
                'label' => 'Nom Super Attaque',
                'attr' => [
                    'placeholder' => 'Ex.: Big Bang Kamehameha !'
                ]
            ])
            ->add('descriptionsuperattaque', TextareaType::class, [
                'label' => 'Description Super Attaque',
                'attr' => [
                    'placeholder' => 'Ex.: Baisse la def ennemie de 50%'
                ]
            ])
            ->add('nompassiveskill', TextType::class, [
                'label' => 'Nom Passive Skill',
                'attr' => [
                    'placeholder' => 'Ex.: Dernier Espoir'
                ]
            ])
            ->add('descriptionpassiveskill', TextareaType::class, [
                'label' => 'Description Passive Skill',
                'attr' => [
                    'placeholder' => 'Ex.: Augmente la def des alliées de 10%'
                ]
            ])
            ->add('listedesliensdupersonnage', TextareaType::class, [
                'label' => 'Listes Des Liens Du Personnage',
                'attr' => [
                    'placeholder' => 'Ex.: Kamehameha - Super Saiyan - etc...'
                ]
            ])
            ->add('listedescategoriesdupersonnage', TextareaType::class, [
                'label' => 'Listes Des Catégories Du Personnage',
                'attr' => [
                    'placeholder' => 'Ex.: Ecole tortue - Arc Enfant etc...'
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
            'data_class' => FichePersonnageRareteSsr::class,
        ]);
    }
}
