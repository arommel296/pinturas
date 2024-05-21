<?php

namespace App\Controller\Admin;

use App\Entity\Factura;
use App\Entity\Presupuesto;
use App\Entity\Servicio;
use App\Entity\Trabajo;
use App\Entity\Usuario;
use App\Entity\Valoracion;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Pinturas');
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
            // ->update(Crud::PAGE_INDEX, '', '');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('General');
        yield MenuItem::linkToRoute('FrontEnd', 'fa fa-home', 'principal');
        yield MenuItem::linkToRoute('Principal', 'fa fa-hammer', 'admin');
        yield MenuItem::linkToCrud('Usuarios', 'fas fa-users', Usuario::class);
        // yield MenuItem::linkToLogout('Cerrar Sesión', 'fa fa-sign-out');
        yield MenuItem::section('Papeleo');
        // yield MenuItem::linkToRoute('Rutas', 'fas fa-map-marked-alt', 'creaRuta');
        yield MenuItem::linkToCrud('Factura', 'fa-solid fa-money-bill', Factura::class);
        yield MenuItem::linkToCrud('Presupuesto', 'fa-solid fa-clipboard-question', Presupuesto::class);
        yield MenuItem::linkToCrud('Servicio', 'fas fa-archway', Servicio::class);
        yield MenuItem::linkToCrud('Trabajo', 'fas fa-bookmark', Trabajo::class);
        yield MenuItem::linkToCrud('Valoraciones', 'fas fa-magnifying-glass-location', Valoracion::class);
    }
}
