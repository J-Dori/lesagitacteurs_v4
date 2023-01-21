<?php

namespace App\Controller\Admin\Financial;

use Doctrine\ORM\QueryBuilder;
use App\Entity\Financial\FinCategory;
use Doctrine\Common\Collections\Criteria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FinCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FinCategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des Catégories')
            ->setPageTitle(Crud::PAGE_EDIT, 'Éditer : %entity_as_string%')
            ->setPageTitle(Crud::PAGE_NEW, 'Nouvelle catégorie')
            ->setEntityLabelInSingular('Catégorie')
            ->setEntityLabelInPlural('Catégories')
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE);
        $actions->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER);
        $actions->update(Crud::PAGE_INDEX, Action::NEW,
             fn (Action $action) => $action->setLabel('Créer catégorie'));
        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name', 'Nom de la catégorie');
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $queryBuilder
            ->orderBy('entity.name', Criteria::ASC)
        ;
    }
    
}
