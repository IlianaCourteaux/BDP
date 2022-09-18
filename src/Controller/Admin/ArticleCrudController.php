<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{

    // public const ARTICLES_BASE_PATH ='img/upload/photo';
    // public const ARTICLES_UPLOAD_DIR ='public/img/upload/photo';
    // public const BANNER_BASE_PATH ='img/upload/banner'; 
    // public const BANNER_UPLOAD_DIR ='public/img/upload/banner';

    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Articles')
            ->setEntityLabelInSingular('Article')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre'),
            TextField::new('slug'),
            TextField::new('author', 'Auteurice'),
            TextEditorField::new('text', 'Texte')
                ->hideOnIndex()
                ->setFormType(CKEditorType::class),
            AssociationField::new('image'),
            AssociationField::new('banner', 'Bannière'),
            // ImageField::new('photo', 'Image')
            //     ->setBasePath(self::ARTICLES_BASE_PATH)
            //     ->setUploadDir(self::ARTICLES_UPLOAD_DIR)
            //     ->setSortable(false)
            //     ->setRequired(false),
            // ImageField::new('banner', 'Bannière')
            //     ->setBasePath(self::BANNER_BASE_PATH)
            //     ->setUploadDir(self::BANNER_UPLOAD_DIR)
            //     ->setSortable(false)
            //     ->setRequired(false),
            TextField::new('keywords', 'Mots-clés')->setSortable(false),
            AssociationField::new('category', 'Catégorie'),
            AssociationField::new('subCategories', 'Sous-Catégories'),
            BooleanField::new('published', 'Publié'),
            DateTimeField::new('createdAt', 'Date de création')->hideOnForm(),
            DateTimeField::new('updatedAt', 'Dernière modification')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Article) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Article) return;

        $entityInstance->setUpdatedAt(new \DateTimeImmutable);

        parent::updateEntity($entityManager, $entityInstance);
    }
}
