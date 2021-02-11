<?php

namespace App\Controller\Admin;


use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Season;
use App\Entity\Team;
use App\Entity\Injury;
use App\Entity\Suspended;
use App\Entity\Category;
use App\Entity\League;
use App\Entity\MatchHandball;
use App\Entity\Role;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('<img src="medias/photos/logo.jpeg" style="border-radius:50%; width: 100px;">');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Accueil', 'fa fa-home', 'home');
        // yield MenuItem::linktoDashboard('Dashboard', 'fa fa-database');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Seasons', 'fa fa-circle', Season::class);
        yield MenuItem::linkToCrud('Laegues', 'fa fa-tags', League::class);
        yield MenuItem::linkToCrud('Matchs', 'fa fa-circle', MatchHandball::class);
        yield MenuItem::linkToCrud('Categories', 'fa fa-circle', Category::class);
        yield MenuItem::linkToCrud('Teams', 'fa fa-circle', Team::class);
        yield MenuItem::linkToCrud('Roles', 'fa fa-tags', Role::class);
        yield MenuItem::linkToCrud('Injures', 'fa fa-circle', Injury::class);
        yield MenuItem::linkToCrud('Suspendeds', 'fa fa-circle', Suspended::class);
        //yield MenuItem::linkToLogout('Logout', 'fa fa-exit');
    }
    

    
}
