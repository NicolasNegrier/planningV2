<?php

namespace App\Form;

use App\Entity\Day;
use App\Entity\Slot;
use App\Entity\Task;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
            // ->add('days', EntityType::class, [
            //     'label' => 'Les jours',
            //     'placeholder' => '-- Choisir les jours --',
            //     'expanded' => true,
            //     'multiple' => true,
            //     'class' => Day::class,
            //     'choice_label' => function ($date) {
            //         return $date->getDate()->format('d/m/Y');
            //     }
            // ])
        ;

        // Modification du formulaire suivant un evenement
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();

            /** @var User */
            $user = $event->getData();

            // Si je suis en attribution de poste sur un slot, j'affiche les inputs de choix des créneaux et des poste
            if ($user->getId() !== null) {
                $form->add('tasks', EntityType::class, [
                    'label' => 'Les Taches',
                    'placeholder' => '-- Choisir les taches --',
                    'class' => Task::class,
                    'choice_label' => 'name',
                    'mapped' => false
                ])
                    ->add('slots', EntityType::class, [
                        'label' => 'Les créneaux',
                        'placeholder' => '-- Choisir les créneaux --',
                        'class' => Slot::class,
                        'choice_label' => 'name',
                        'expanded' => true,
                        'multiple' => true,
                    ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
