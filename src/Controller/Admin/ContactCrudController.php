<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Demandes de contact')
            ->setEntityLabelInSingular('Demande de contact');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email')->setFormTypeOption('disabled', 'disabled'),
            TextField::new('username', 'Pseudo')->setFormTypeOption('disabled', 'disabled'),
            TextField::new('discord', 'Pseudo Discord')->setFormTypeOption('disabled', 'disabled'),
            TextField::new('object', 'Sujet'),
            TextareaField::new('message')->hideOnIndex()->setFormTypeOption('disabled', 'disabled'),
            DateTimeField::new('createdAt', 'Date de création')->hideOnForm(),
        ];
    }
}
