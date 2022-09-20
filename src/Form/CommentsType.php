<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Comments;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Validator\Constraints as Assert;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', TypeTextType::class, [
                'attr' => [
                    'class' => 'form_item',
                ],
                'label' => 'Pseudo',
                'label_attr' => [
                    'class' => 'form_label'
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('text', CKEditorType::class, [
                'attr' => [
                    'class' => 'form_item',
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
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'submit_button'],
                'label' => 'Envoyer'
            ]);

        // Pour essayer d'avoir l'ID plutôt que le titre de l'article de passé dans le hiddentype ?
        // $builder->get('article')
        //     ->addModelTransformer(new CallbackTransformer(
        //         fn (Article $article) => $article->getId(),
        //         fn (Article $article) => $article->getTitle()
        //     ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
