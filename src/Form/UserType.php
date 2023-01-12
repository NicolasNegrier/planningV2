<?php

namespace App\Form;

use App\Entity\Day;
use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'agent',
                'attr' => ['placeholder' => 'Tapez le nom de l\'agent']
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prenom de l\'agent',
                'attr' => ['placeholder' => 'Tapez le prénom de l\'agent']
            ])
            ->add('days', EntityType::class, [
                'label' => 'Les jours',
                'placeholder' => '-- Choisir les jours --',
                'expanded' => true,
                'multiple' => true,
                'class' => Day::class,
                'choice_label' => function ($date) {
                    return $date->getDate()->format('d/m/Y');
                }
            ])
            ->add('tasks', EntityType::class, [
                'label' => 'Les Taches',
                'placeholder' => '-- Choisir les taches --',
                'expanded' => true,
                'multiple' => true,
                'class' => Task::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
