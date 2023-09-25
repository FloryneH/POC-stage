<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Formation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct( private AdminUrlGenerator $adminUrlGenerator )
    {
        
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url =  $this->adminUrlGenerator->setController(ArticleCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('PasSage Avenir');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Aller sur le site', 'fa fa-undo', 'app_home');
        
        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Tous les articles', 'fas fa-newspaper', Article::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Formations', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Toutes les formations', 'fas fa-newspaper', Formation::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Formation::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class);

        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comment', Comment::class);
    }
}