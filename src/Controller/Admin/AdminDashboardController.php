<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Project;
use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Doctrine\ORM\EntityManagerInterface;

class AdminDashboardController extends AbstractDashboardController
{
    private $entityManagerInterface;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $projectRepository = $this->entityManagerInterface->getRepository(Project::class);
        $projectsCount = $projectRepository->count([]);

        $categoryRepository = $this->entityManagerInterface->getRepository(Category::class);
        $categoriesCount = $categoryRepository->count([]);

        $pageRepository = $this->entityManagerInterface->getRepository(Page::class);
        $pagesCount = $pageRepository->count([]);

        $dataCount = array();

        $dataCount[] = array('title' => 'Categories', 'count' => $categoriesCount);
        $dataCount[] = array('title' => 'Projects', 'count' => $projectsCount);
        $dataCount[] = array('title' => 'Pages', 'count' => $pagesCount);

        return $this->render('admin/dashboard.html.twig', ['dataCount' => $dataCount]);
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setPaginatorPageSize(40)
            ->setPaginatorRangeSize(3)
            ->showEntityActionsInlined()
        ;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration')
            ->setFaviconPath('/favicon.svg');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Content');
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Projects', 'fas fa-list', Project::class);
        yield MenuItem::linkToCrud('Pages', 'fas fa-list', Page::class);
        yield MenuItem::section('Site');
        yield MenuItem::linkToUrl('Visit site', 'fa fa-home', '/');
        yield MenuItem::section('User');
        yield MenuItem::linkToLogout('Logout', 'fa fa-sign-out');
    }

    public function configureAssets(): Assets
    {
        // EasyAdmin Serenity theme
        // https://github.com/volkar/easyadmin-serenity-theme
        return parent::configureAssets()->addCssFile('static/easyadmin_serenity_theme.css');
    }
}
