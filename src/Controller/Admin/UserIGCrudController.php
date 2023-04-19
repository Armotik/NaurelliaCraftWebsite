<?php

namespace App\Controller\Admin;

use App\Entity\ShopItem;
use App\Entity\UserIG;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserIGCrudController extends AbstractCrudController
{
    /**
     * @return string The fully qualified class name of the entity managed by this CRUD controller.
     */
    public static function getEntityFqcn(): string
    {
        return UserIG::class;
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
     * @throws Exception
     */
    public function configureFields(string $pageName): iterable
    {

        return [
            IdField::new('uuid', 'UUID')->setDisabled(),
            TextField::new('username', 'Username'),
            DateField::new('first_join_at', 'First Join Date')->setDisabled(),
            DateField::new('last_join_at', 'Last Join Date')->setDisabled(),
            BooleanField::new('isOnline', 'Is Online'),
            BooleanField::new('isOp', 'Is OP')->setDisabled(),
            CollectionField::new('ranks', 'Ranks')->setEntryType(EntityType::class)->setFormType(CollectionType::class)->setFormTypeOptions([
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => ShopItem::class,
                    'choice_label' => 'designation',
                ],
            ])
        ];
    }
}
