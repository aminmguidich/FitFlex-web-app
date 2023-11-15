<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType; // Ajout de cette ligne pour le champ de type fichier


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('description', TextType::class, [
            'constraints' => [
                new NotBlank(['message' => 'La description ne peut pas être vide.']),
                new Length([
                    'max' => 255,
                    'maxMessage' => 'La description ne peut pas dépasser {{ limit }} caractères.',
                ]),
            ],
        ])
        /*->add('image', FileType::class, [
            'label' => 'image',
            'constraints' => [
                new NotBlank(['message' => 'Veuillez sélectionner une image.']),
                new Length(['max' => 255]),
                 new Image([
                    'maxSize' => '5M',
                    'mimeTypes' => ['image/jpeg', 'image/png'],
                    'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPEG ou PNG) de taille maximale 5Mo.',
                ]),
            ],
        ])*/
        ->add('image')

        
        
            ->add('idUser', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'id', // Remplacez 'username' par la propriété de l'objet User que vous souhaitez utiliser comme libellé
                'constraints' => [
                    new Valid(),
                ],
           
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
