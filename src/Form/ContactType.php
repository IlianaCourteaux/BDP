<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr'=> [
                    'class' => 'form_item',
                    'minlength' => '2',
                    'maxlength' => '180',
                ],
                'label' => 'Adresse email',
                'label_attr' => [
                    'class' => 'form_label'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length(['min' => 2, 'max' => 180])
                ]
            ])
            ->add('username', TextType::class, [
                'attr'=> [
                    'class' => 'form_item',
                    'minlength' => '3',
                    'maxlength' => '50',
                ],
                'label' => 'Pseudo',
                'label_attr' => [
                    'class' => 'form_label'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 3, 'max' => 50])
                ]
            ])
            ->add('discord',TextType::class, [
                'attr'=> [
                    'class' => 'form_item',
                    'minlength' => '3',
                    'maxlength' => '50',
                ],
                'label' => "Nom d'utilisateur Discord (Facultatif)",
                'label_attr' => [
                    'class' => 'form_label'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 3, 'max' => 50])
                ]
            ])
            ->add('object', ChoiceType::class, [
                'attr' => [
                    'class' => 'form_item form_choice',
                ],
                'choices'  => [
                    'Candidature en guilde' => 'Candidature',
                    'Demande de renseignements' => 'Renseignements',
                    'Autre sujet' => 'Autre',
                ],
                'label' => "Sujet",
                'label_attr' => [
                    'class' => 'form_label'
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form_item form_message',
                ],
                'label' => 'Message',
                'label_attr' => [
                    'class' => 'form_label'
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'submit_button'
                ],
                'label' => 'Envoyer'
            ]);;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
