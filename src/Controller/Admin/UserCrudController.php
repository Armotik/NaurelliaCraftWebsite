<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    /**
     * @return string The fully qualified class name of the entity managed by this CRUD controller.
     */
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    /**
     * @param Crud $crud The Crud object that defines the configuration of the CRUD controller
     * @return Crud The updated Crud object
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->renderContentMaximized()
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('Users')
            ->setEntityPermission('ROLE_ADMIN')
            ->setPageTitle('index', 'NaurelliaCraft | Admin Panel - %entity_label_plural%')
            ->setPaginatorPageSize(30)
        ;
    }

    /**
     * @param string $pageName The name of the page where the fields are displayed
     * @return iterable The iterable of fields that define the CRUD controller
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new("code")->setDisabled(true),
            TextField::new('username'),
            TextField::new('mail'),
            DateField::new('createdAt'),
            ArrayField::new('roles'),
            BooleanField::new('isLinked'),
            BooleanField::new('isVerified'),
        ];
    }
}
