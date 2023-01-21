<?php

namespace App\Controller\Admin\Financial;

use Doctrine\ORM\QueryBuilder;
use App\Entity\Financial\FinBilan;
use App\Repository\PlayRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FinBilanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FinBilan::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des Bilans')
            ->setPageTitle(Crud::PAGE_EDIT, 'Éditer bilan')
            ->setPageTitle(Crud::PAGE_NEW, 'Nouveau bilan')
            ->setEntityLabelInSingular('Bilan')
            ->setEntityLabelInPlural('Bilans')
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE);
        $actions->remove(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER);
        $actions->update(Crud::PAGE_INDEX, Action::NEW,
             fn (Action $action) => $action->setLabel('Créer bilan'));
        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('year', 'Année')->setColumns(1);
        yield FormField::addRow();
        yield AssociationField::new('play', 'Pièce')->setColumns(3)
            ->setFormTypeOption('query_builder', function (PlayRepository $entityRepository) {
                return $entityRepository->createQueryBuilder('e')
                ->orderBy('e.year', 'DESC');
            });

        if ($pageName == Crud::PAGE_INDEX) {
            yield BooleanField::new('active', 'Session ouverte')->renderAsSwitch(false);
        } else {
            yield BooleanField::new('active', 'Session ouverte')->renderAsSwitch(true);
        }
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $year = $entityInstance->getYear();

    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $queryBuilder
            ->orderBy('entity.year', Criteria::DESC)
            ->addOrderBy('entity.play', Criteria::ASC)
        ;
    }
}
