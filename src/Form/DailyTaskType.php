<?php

namespace App\Form;

use App\Entity\DailyTask;
use App\Entity\Slot;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DailyTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('day', EntityType::class, [
            //     'label' => 'L\'agent',
            //     'placeholder' => '-- Choisir les agents --',
            //     'expanded' => true,
            //     'multiple' => true,
            //     'class' => User::class,
            //     'choice_label' => 'name'
            // ])
            ->add('task', EntityType::class, [
                'label' => 'Le poste',
                'placeholder' => '-- Choisir le poste --',
                'class' => Task::class,
                'choice_label' => 'name'
            ])
            ->add('slots', EntityType::class, [
                'label' => 'Les créneaux',
                'placeholder' => '-- Choisir les créneaux --',
                'expanded' => true,
                'multiple' => true,
                'class' => Slot::class,
                'choice_label' => 'name'
            ])
            ->add('users', EntityType::class, [
                'label' => 'Les agents',
                'placeholder' => '-- Choisir les agents --',
                'expanded' => true,
                'multiple' => true,
                'class' => User::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DailyTask::class,
        ]);
    }
}
