<?php

namespace App\Controller\Admin;

use App\Entity\Infractions;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Doctrine\DBAL\Types\FloatType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InfractionsCrudController extends AbstractCrudController
{
    /**
     * @return string The fully qualified class name of the entity managed by this CRUD controller.
     */
    public static function getEntityFqcn(): string
    {
        return Infractions::class;
    }

    /**
     * @param Crud $crud The Crud object that defines the configuration of the CRUD controller
     * @return Crud The updated Crud object
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setEntityLabelInSingular('Infraction')
            ->setEntityLabelInPlural('Infractions')
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
            IdField::new('id', 'ID')->setDisabled(),
            IdField::new('targetUUID.username', 'Target'),
            IdField::new('staffUUID.username', 'Staff'),
            TextField::new('type', 'Type'),
            TextField::new('reason', 'Reason'),
            NumberField::new('duration', "Duration")->setCustomOption(FloatType::class, [
                'scale' => 0,
            ]),
            DateField::new('date', 'Date'),
            DateField::new('end_date', 'End Date'),
            BooleanField::new('status', 'Status')
        ];
    }
}
