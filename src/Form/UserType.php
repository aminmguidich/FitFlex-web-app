<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType; // Use Symfony's built-in EmailType
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; // Use Symfony's built-in EmailType

use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('mdp')
            ->add('role',ChoiceType::class, [
                'label' => 'Role',
                'choices' => [
                    'Admin' => 'Admin',
                    'Utilisateur' => 'Utilisateur',
                    'Coach' => 'Coach',
                    // Add more options as needed
                ],
                'placeholder' => 'Select Role', // Optional
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('img')//Upload file TO DO
            ->add('age')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
