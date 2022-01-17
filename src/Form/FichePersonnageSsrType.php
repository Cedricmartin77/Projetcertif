<?php

namespace App\Form;

use App\Entity\FichePersonnageSsr;
use App\Entity\EncyclopedieDuPersonnage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FichePersonnageSsrType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('encyclopediedupersonnage', EntityType::class, [
            'class' => EncyclopedieDuPersonnage::class,
            'choice_label' => 'title',
            'label' => 'Encyclopedie Du Personnage'
        ])
        ->add('img', FileType::class, [
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
            ->add('nomaptitudepassive', TextType::class, [
                'label' => 'Aptitude Passive',
                'attr' => [
                    'placeholder' => 'Ex.: Saiyan au coeur d\'or'
                ]
            ])
            ->add('descriptionaptitudepassive', TextareaType::class, [
                'label' => 'Description Aptittude Passive',
                'attr' => [
                    'placeholder' => 'Ex.: Bloque lennemie'
                ]
            ])
            ->add('listedesliensdupersonnage', TextareaType::class, [
                'label' => 'Listes des Liens du Personnage',
                'attr' => [
                    'placeholder' => 'Ex.: Kamehameha - Super Saiyan'
                ]
            ])
            ->add('listedescategoriesdupersonnage', TextareaType::class, [
                'label' => 'Listes des Catégories du Personnage',
                'attr' => [
                    'placeholder' => 'Ex.: Ecole de la tortue - Super Saiyan'
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
            'data_class' => FichePersonnageSsr::class,
        ]);
    }
}
