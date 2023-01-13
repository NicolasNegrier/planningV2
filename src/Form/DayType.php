<?php

namespace App\Form;

use App\Entity\Day;
use App\Entity\Slot;
use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du jour',
                'attr' => ['placeholder' => 'Tapez le nom du jour, ex: Lundi']
            ])
            ->add('date', DateType::class, [
                'label' => 'La date du jour',
                'widget' => 'choice',
                'format' => 'dd-MM-yyyy'
            ])
            ->add('users', EntityType::class, [
                'label' => 'L\'agent',
                'placeholder' => '-- Choisir les agents --',
                'expanded' => true,
                'multiple' => true,
                'class' => User::class,
                'choice_label' => 'name'
            ])
            ->add('slots', EntityType::class, [
                'label' => 'Les creneaux',
                'placeholder' => '-- Choisir les creneaux --',
                'expanded' => true,
                'multiple' => true,
                'class' => Slot::class,
                'choice_label' => 'name'
            ])
            ->add('tasks', EntityType::class, [
                'label' => 'Les creneaux',
                'placeholder' => '-- Choisir les creneaux --',
                'expanded' => true,
                'multiple' => true,
                'class' => Task::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Day::class,
        ]);
    }
}
