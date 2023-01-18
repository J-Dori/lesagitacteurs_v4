<?php

namespace App\Controller\Admin\Financial;

use App\Entity\Financial\FinBank;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class FinBankCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FinBank::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Comptes Bancaires')
            ->setPageTitle(Crud::PAGE_EDIT, 'Éditer : %entity_as_string%')
            ->setPageTitle(Crud::PAGE_NEW, 'Nouveau compte')
            ->setEntityLabelInSingular('Compte bancaire')
            ->setEntityLabelInPlural('Comptes bancaires')
        ;
    }
    
    public function configureActions(Actions $actions): Actions
    {
        $actions->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE);
        $actions->update(Crud::PAGE_INDEX, Action::NEW,
             fn (Action $action) => $action->setLabel('Ajouter compte bancaire'));
        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('year', 'Session ouverte');
        yield TextField::new('bankName', 'Nom de la banque');
        yield NumberField::new('balance', 'Solde')->setNumDecimals(2);
        if ($pageName == Crud::PAGE_INDEX)
            yield BooleanField::new('active', 'Actif')->renderAsSwitch(false);
        else
            yield BooleanField::new('active', 'Actif')->renderAsSwitch(true);
    }

}
