<?php

namespace App\Controller\Admin\Financial;

use App\Entity\Financial\FinExpense;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FinExpenseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FinExpense::class;
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
}
