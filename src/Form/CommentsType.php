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

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', TypeTextType::class, [
                'label' => 'Pseudo'
            ])
            ->add('text', CKEditorType::class, [
                'label' => 'Commentaire'
            ])
            ->add('article', HiddenType::class)
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'button'],
                'label' => 'Envoyer'
            ]);

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
