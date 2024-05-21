<?php

namespace App\Controller\Admin;

use App\Entity\Presupuesto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class PresupuestoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Presupuesto::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */

    public function configureActions(Actions $actions): Actions
    {
        // return parent::configureActions()
        return $actions
        // ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->update(Crud::PAGE_INDEX, Action::NEW , function (Action $action) {
            return $action->linkToRoute('creaPresupuesto', []);
        });
        
    }

    #[Route('/creaPresupuesto', name: 'creaPresupuesto')]
    public function nuevaRuta(): Response
    {
        return $this->render('presupuesto/nupr.html.twig');
    }
}
