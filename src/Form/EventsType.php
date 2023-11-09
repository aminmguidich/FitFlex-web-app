<?php

namespace App\Form;

use App\Entity\Events;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EventsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titreevent')
            ->add('nomcoach')
            ->add('typeevent')
            ->add('adresseevent')
            ->add('prixevent')
            ->add('dateevent', DateType::class, [
                'widget' => 'choice',
            ])
            ->add('imgevent')
            ->add('nombreplacesreservees')
            ->add('nombreplacestotal')
            ->add('idUser')
            ->add('idtype')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Events::class,
        ]);
    }
}
