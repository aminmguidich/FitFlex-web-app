<?php

namespace App\Form;

use App\Entity\produit;
use App\Entity\categoriemagasin;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints as Assert;

class produitType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       
        $builder
        ->add('idadmin', null, [
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le champ Admin ID doit être rempli.']),
                new Assert\GreaterThan(['value' => 0, 'message' => 'Le champ Admin ID doit être un nombre positif.']),

            ],
        ])
        ->add('titre', null, [
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le champ Description doit être rempli.']),
                new Assert\Regex([
                    'pattern' => '/^[a-zA-Z]+$/',
                    'message' => 'Le champ Description doit être une chaîne de caractères.',
                ]),
                new Assert\Length([
                    'min' => 3,
                    'max' => 50,
                    'minMessage' => 'La description doit avoir au moins {{ limit }} caractères.',
                    'maxMessage' => 'La description doit avoir au plus {{ limit }} caractères.',
                ]),
            ],
        ])
        ->add('image', null, [
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le champ Image doit être rempli.']),
            ],
        ])
        ->add('date', null, [
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le champ Date doit être rempli.']),
  
            ],
        ])
        ->add('description', null, [
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le champ Description doit être rempli.']),
                new Assert\Regex([
                    'pattern' => '/^[a-zA-Z]+$/',
                    'message' => 'Le champ Description doit être une chaîne de caractères.',
                ]),
                new Assert\Length([
                    'min' => 3,
                    'max' => 50,
                    'minMessage' => 'La description doit avoir au moins {{ limit }} caractères.',
                    'maxMessage' => 'La description doit avoir au plus {{ limit }} caractères.',
                ]),
            ],
        ])
        ->add('categorie', null, [
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le champ Catégorie doit être rempli.']),
            ],
        ])
        ->add('idcategorie', EntityType::class, [
            'class' => Categoriemagasin::class,
            'choice_label' => 'categorie',
            'placeholder' => 'Choose a category',
            'constraints' => [
                new Assert\NotBlank(['message' => 'Le champ Catégorie ID doit être rempli.']),
            ],
        ]);
}

    private function getCategoryChoices()
    {
        
        $categories = $this->entityManager->getRepository(categoriemagasin::class)->findAll();

        $choices = [];
        foreach ($categories as $category) {
            $choices[$category->getCategorie()] = $category->getId();
        }

        return $choices;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => produit::class,
        ]);
    }
}
