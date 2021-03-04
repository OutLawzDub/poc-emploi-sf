<?php

namespace App\Form;

use App\Entity\Campagne;
use App\Entity\Horaire;
use App\Entity\Job;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HoraireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_start')
            ->add('date_end')
            ->add('campagne', EntityType::class, [
                'class' => Campagne::class,
                'label' => 'Campagne',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.nom_campagne', 'ASC');
                },
                'choice_label' => 'nom_campagne'
            ])
            ->add('job', EntityType::class, [
                'class' => Job::class,
                'label' => 'Job',
                'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('j')
                    ->orderBy('j.job', 'ASC');
                },
                'choice_label' => 'job'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Horaire::class,
        ]);
    }
}
