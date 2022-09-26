<?php

namespace App\Form;

use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', TextType::class, [
                'attr' => [
                    'class' => 'form_item comment-user-item',
                ],
                'label' => 'Pseudo',
                'label_attr' => [
                    'class' => 'form_label'
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('text', TextareaType::class, [
                'attr' => [
                    'class' => 'form_item comment-text-item',
                ],
                'label' => 'Commentaire',
                'label_attr' => [
                    'class' => 'form_label'
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('article', HiddenType::class)
            ->add('parent', HiddenType::class, [
                'mapped' => false
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'submit_button comment_submit_button'
                ],
                'label' => 'Poster mon commentaire'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
