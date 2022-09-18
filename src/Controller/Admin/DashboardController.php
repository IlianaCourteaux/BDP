<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comments;
use App\Entity\Contact;
use App\Entity\Media;
use App\Entity\Page;
use App\Entity\SubCategory;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ){

    }

    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(ArticleCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Les Bâtonnets de Poisson');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour sur le site', 'fa fa-undo', 'app_home');
        
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');

        // Section articles
        yield MenuItem::section('Articles');

        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Tous les articles', 'fas fa-eye', Article::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW)
        ]);

        yield MenuItem::subMenu('Catégories', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Toutes les catégories', 'fas fa-eye', Category::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW)
            
        ]);

        yield MenuItem::subMenu('Sous-Catégories', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Toutes les sous-catégories', 'fas fa-eye', SubCategory::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', SubCategory::class)->setAction(Crud::PAGE_NEW)
            
        ]);

        yield MenuItem::subMenu('Médias', 'fas fa-photo-video')->setSubItems([
            MenuItem::linkToCrud('Ajouter un média', 'fas fa-plus', Media::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Médiathèque', 'fas fa-eye', Media::class)
        ]);

        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comment', Comments::class);

        // Section pages
        yield MenuItem::section('Pages');

        yield MenuItem::linkToCrud('Toutes les pages', 'fas fa-eye', Page::class);
        yield MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Page::class)->setAction(Crud::PAGE_NEW);

        // Section Utilisateurs
        yield MenuItem::section('Utilisateurs');

        yield MenuItem::linkToCrud('Liste des utilisateurs', 'fas fa-user', Users::class);

        yield MenuItem::linkToCrud('Demandes de contact', 'fas fa-envelope', Contact::class);
    }
}
