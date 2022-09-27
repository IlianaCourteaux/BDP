<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UsersPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('password', PasswordType::class, [
                'attr'=> [
                    'class' => 'form_item'
                ],
                    'label' => "Mot de passe actuel",
                    'label_attr' => [
                        'class' => 'form_label'
                ]
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                
                'first_options' => [
                    'attr'=> [
                        'class' => 'form_item'
                    ],
                    'label' => "Nouveau mot de passe",
                    'label_attr' => [
                        'class' => 'form_label'
                    ],
                    'constraints' => [new Assert\NotBlank()]
                ],
                
                'second_options' => [
                    'attr'=> [
                        'class' => 'form_item'
                    ],
                    'label' => 'Confirmation du nouveau mot de passe',
                    'label_attr' => [
                        'class' => 'form_label'
                    ],
                    'constraints' => [new Assert\NotBlank()]
                ],

                'invalid_message' => 'Les nouveaux mots de passe ne correspondent pas'
            ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'submit_button'
                ]
                ]);
    }
}