<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, [
            'attr'=> [
                'class' => 'form_control',
                'minlength' => '3',
                'maxlength' => '50',
            ],
            'label' => 'Pseudo (modifier si nécéssaire)',
            'label_attr' => [
                'class' => 'form_label'
            ],
            'constraints' => [
                new Assert\Length(['min' => 3, 'max' => 50])
            ]
        ])
        ->add('email', EmailType::class, [
            'attr'=> [
                'class' => 'form_control',
                'minlength' => '2',
                'maxlength' => '180',
            ],
            'label' => 'Adresse email (modifier si nécéssaire)',
            'label_attr' => [
                'class' => 'form_label'
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Email(),
                new Assert\Length(['min' => 2, 'max' => 180])
            ]
        ])
        ->add('password', PasswordType::class, [
            'label' => "Confirmez votre mot de passe"
    ])
        // ->add('password', PasswordType::class, [
        //     'attr' => [
        //         'class' => 'form_control'
        //     ],
        //     'label' => "Confirmez votre mot de passe",
        //     'label_attr' => [
        //         'class' => 'form_label'
        //     ]
        // ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'button'
            ]
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
