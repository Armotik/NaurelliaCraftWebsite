<?php

namespace App\Controller\Admin;

use App\Entity\Infractions;
use App\Entity\ShopItem;
use App\Entity\User;
use App\Entity\UserIG;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    /**
     *
     * @return Response If the user is not an admin, it will redirect him to the homepage
     *
     * @Route("/admin", name="admin")
     */
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $admin = false;

        // Check if the user is an admin
        for ($i = 0 ; $i < sizeof($this->getUser()->getRoles()) ; $i++) {

            if ($this->getUser()->getRoles()[$i] == "ROLE_ADMIN") $admin = true;
        }

        // If the user is not an admin, redirect him to the homepage
        if (!$admin) return $this->render('default/index.html.twig');

        // If the user is an admin, redirect him to the admin panel
        return $this->render('admin/dashboard.html.twig');
    }

    /**
     * @return Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('NaurelliaCraft | Admin Panel')
            ->renderContentMaximized();
    }

    /**
     * @return iterable
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('In Game Users', 'fas fa-user-shield', UserIG::class);
        yield MenuItem::linkToCrud('In Game Infractions', 'fas fa-skull-crossbones', Infractions::class);
        yield MenuItem::linkToCrud('Shop Items', 'fas fa-shopping-cart', ShopItem::class);
    }
}
