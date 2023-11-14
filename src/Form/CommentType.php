<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content')
            ->add('idpost', EntityType::class, [
                'class' => 'App\Entity\Post',
                'choice_label' => 'idpost', // ou une autre propriété de l'entité Post à afficher dans le champ
                
                ])
            ->add('idUser', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'id', // Remplacez 'username' par la propriété de l'objet User que vous souhaitez utiliser comme libellé
            ]);
    }
        
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
