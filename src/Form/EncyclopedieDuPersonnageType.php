<?php

namespace App\Form;

use App\Entity\EncyclopedieDuPersonnage;
use Symfony\Component\Form\AbstractType;
use App\Entity\EncyclopedieDesPersonnages;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EncyclopedieDuPersonnageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
            'label' => 'Nom du Personnage',
            'attr' => [
                'placeholder' => 'Ex.: Son Goku'
            ]
        ])
        ->add('encyclopedie_des_personnages', EntityType::class, [
            'class' => EncyclopedieDesPersonnages::class,
            'choice_label' => 'title'
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
                    'mimeTypesMessage' => 'Merci de sélectionner une iamge au format PNG, JPG, JPEG ou JP2'
                ])
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EncyclopedieDuPersonnage::class,
        ]);
    }
}
