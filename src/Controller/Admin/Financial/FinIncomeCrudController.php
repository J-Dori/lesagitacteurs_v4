<?php

namespace App\Controller\Admin\Financial;

use App\Trait\PayModeEnum;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Financial\FinIncome;
use Doctrine\Common\Collections\Criteria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use Adeliom\EasyFieldsBundle\Admin\Field\EnumField;
use App\Repository\Financial\FinBankRepository;
use App\Repository\Financial\FinCategoryRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FinIncomeCrudController extends AbstractCrudController
{
    public function __construct(private FinBankRepository $finBankRepository) 
    { }

    public static function getEntityFqcn(): string
    {
        return FinIncome::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des Revenus')
            ->setPageTitle(Crud::PAGE_EDIT, 'Éditer : %entity_as_string%')
            ->setPageTitle(Crud::PAGE_NEW, 'Nouveau revenu')
            ->setEntityLabelInSingular('Revenu')
            ->setEntityLabelInPlural('Revenus')
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE);
        $actions->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER);
        $actions->update(Crud::PAGE_INDEX, Action::NEW,
             fn (Action $action) => $action->setLabel('Créer revenu'));
        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {
        if ($pageName == Crud::PAGE_INDEX) {
            yield DateField::new('date', 'Date');
            yield AssociationField::new('play', 'Pièce');
        
            yield AssociationField::new('category', 'Catégorie')
                ->setFormTypeOption('query_builder', function (FinCategoryRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('e')
                        ->orderBy('e.name', 'ASC');
            });
            
            yield EnumField::new('payMode', 'Mode Paiement')->setEnum(PayModeEnum::class);
            yield NumberField::new('amount', 'Montant')->setNumDecimals(2)->setCssClass('text-right');
            yield TextField::new('docNumber', 'Nº document');
            yield TextareaField::new('notes', 'Notes');
        } else {
            yield FormField::addPanel('')->addCssClass('col-lg-6 col-md-12');
            yield AssociationField::new('play', 'Pièce');
            yield AssociationField::new('category', 'Catégorie')
                ->setFormTypeOption('query_builder', function (FinCategoryRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('e')
                    ->orderBy('e.name', 'ASC');
            });
            yield TextareaField::new('notes', 'Notes')->setColumns(9);
            
            yield FormField::addPanel('')->addCssClass('col-lg-6 col-md-12');
            yield DateField::new('date', 'Date');
            yield NumberField::new('amount', 'Montant')->setNumDecimals(2);
            yield EnumField::new('payMode', 'Mode Paiement')->setEnum(PayModeEnum::class)->setColumns(4);
            yield TextField::new('docNumber', 'Nº Document');
        }
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $year = $this->finBankRepository->getYearOnActiveBank();

        if (empty($year)) {
            $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
            return $queryBuilder
                ->orderBy('entity.date', Criteria::DESC)
            ;
        }

        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $queryBuilder
            ->andWhere('entity.year = :year')->setParameter('year', $year['year'])
            ->orderBy('entity.date', Criteria::DESC)
        ;
    }
}
