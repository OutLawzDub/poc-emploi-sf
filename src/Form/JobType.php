<?php

namespace App\Form;

use App\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('job', TextType::class, [
                'attr' => [
                    'placeholder' => 'Renseignez un job'
                ]
            ])
            ->add('lien', TextType::class, [
                'attr' => [
                    'placeholder' => 'Renseignez un lien'
                ]
            ])
            ->add('id_rom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ajoutez l\'id rom'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
