<?php

namespace App\Controller\Admin;

use App\Entity\ShopItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ShopItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShopItem::class;
    }

    /**
     * @param Crud $crud The Crud object that defines the configuration of the CRUD controller
     * @return Crud The updated Crud object
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setEntityLabelInSingular('Shop Item')
            ->setEntityLabelInPlural('Shop Items')
            ->setEntityPermission('ROLE_ADMIN')
            ->setPageTitle('index', 'NaurelliaCraft | Admin Panel - %entity_label_plural%')
            ->setPaginatorPageSize(30)
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('reference', 'Reference')->setDisabled(),
            TextField::new('designation', 'Designation'),
            TextEditorField::new('description', 'Description'),
            MoneyField::new('price', 'Price')->setCurrency('EUR'),
            NumberField::new('quantity', 'Quantity'),
            BooleanField::new('onShop', 'On Shop'),
            ArrayField::new('advantages', 'Advantages')
        ];
    }

}
