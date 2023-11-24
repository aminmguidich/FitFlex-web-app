<?php

namespace App\Form;

use App\Entity\Activites;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ActivitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('dateDeb',null,[
                'constraints' => [
                    new Assert\NotBlank(['message' => 'dateDeb cannot be blank.']),

                ],])
            ->add('dateFin')
            ->add('description',null,[
                'constraints' => [
                    new Assert\NotBlank(['message' => 'description cannot be blank.']),

                ],])
            ->add('salle',null,[
                'constraints' => [
                    new Assert\NotBlank(['message' => 'salle cannot be blank.']),

                ],])
            ->add('titre',null,[
                'constraints' => [
                    new Assert\NotBlank(['message' => 'titre cannot be blank.']),

                ],])
            ->add('idcategorie')
            ->add('idUser', EntityType::class, [
                'class' => User::class,
                'choice_label' => function (User $user) {
                    return $user->getNom() . ' ' . $user->getPrenom();
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.role = :role')
                        ->setParameter('role', 'Coach');
                },
                // Add your other constraints here
            ])
            ->setAttributes(['novalidate' => 'novalidate']); // Apply novalidate to the entire form
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activites::class,
        ]);
    }
}
