<?php

namespace App\Form;

use App\Entity\Offer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titleoffer')
            ->add('descriptionoffer')
            ->add('prix')
            
            ->add('datedeboffer', DateType::class, [
                'years' => range(2023,2024),
                'format' => 'dd-MM-yyyy',

            ])
            ->add('datefinoffer', DateType::class, [
                'years' => range(2023,2024),
                'format' => 'dd-MM-yyyy',

            ])
            ->add('img')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
