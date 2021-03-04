<?php

namespace App\Form;

use App\Entity\Campagne;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampagneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_campagne', TextType::class, [
                'attr' => [
                    'placeholder' => 'Choisissez un nom explicit'
                ]
            ])
            ->add('date_start', DateTimeType::class, [
                'label' => 'Date début'
            ])
            ->add('date_end', DateTimeType::class, [
                'label' => 'Date de fin'
            ])
            ->add('creator', EntityType::class, [
                'class' => User::class,
                'label' => 'Créateur',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.email', 'ASC');
                },
                'choice_label' => 'email'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Campagne::class,
        ]);
    }
}
