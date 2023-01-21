<?php

namespace App\Controller\Admin\Financial;

use App\Trait\PayModeEnum;
use Doctrine\ORM\QueryBuilder;
use App\Repository\PlayRepository;
use App\Entity\Financial\FinExpense;
use Doctrine\Common\Collections\Criteria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use Adeliom\EasyFieldsBundle\Admin\Field\EnumField;
use App\Repository\Financial\FinBilanRepository;
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

class FinExpenseCrudController extends AbstractCrudController
{
    private $bilan = null;
    private ?string $indexTitle = null;

    public function __construct(
        private FinBilanRepository $finBilanRepository,
    ) 
    {
        // Get selected year on FinBank to list Expenses/Incomes of session 
        $this->bilan = $this->finBilanRepository->getActive();
        $this->indexTitle = !empty($this->bilan) ? 'de ' . $this->bilan->getYear() : '(tous)';
    }

    public static function getEntityFqcn(): string
    {
        return FinExpense::class;
    }

    public function createEntity(string $entityFqcn) {
        $entity = new FinExpense();
        $entity->setPlay( !empty($this->bilan) ? $this->bilan->getPlay() : null );
        $entity->setFinBilan($this->bilan);
        return $entity;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des Dépenses ' . $this->indexTitle)
            ->setPageTitle(Crud::PAGE_EDIT, '%entity_as_string%')
            ->setPageTitle(Crud::PAGE_NEW, 'Nouvelle dépense')
            ->setEntityLabelInSingular('Dépense')
            ->setEntityLabelInPlural('Dépenses')
            ->overrideTemplate('crud/index', 'admin/financial/index_financial.html.twig')
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE);
        $actions->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER);
        $actions->update(Crud::PAGE_INDEX, Action::NEW,
             fn (Action $action) => $action->setLabel('Créer dépense')->addCssClass('btn-danger'));
        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {
        if ($pageName == Crud::PAGE_INDEX) {
            if (empty($this->bilan)) {
                yield TextField::new('finBilan.year', 'Bilan');
            }
            yield DateField::new('date', 'Date');
            yield AssociationField::new('play', 'Pièce');
            yield AssociationField::new('category', 'Catégorie');
            
            yield EnumField::new('payMode', 'Mode Paiement')->setEnum(PayModeEnum::class);
            yield NumberField::new('amount', 'Montant')->setNumDecimals(2)->setTemplatePath('admin/financial/field/currency.html.twig');
            yield TextField::new('docNumber', 'Nº document');
            yield TextareaField::new('notes', 'Notes');
        } else {
            yield FormField::addPanel('')->addCssClass('col-lg-6 col-md-12');
            yield AssociationField::new('finBilan', 'Bilan')->setRequired(true)
                ->setFormTypeOption('query_builder', function (FinBilanRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('e')
                    ->orderBy('e.year', 'DESC');
                });
            yield AssociationField::new('play', 'Pièce')
                ->setFormTypeOption('query_builder', function (PlayRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('e')
                    ->orderBy('e.year', 'DESC');
                });
            
            
            yield FormField::addPanel('')->addCssClass('col-lg-6 col-md-12');
            yield AssociationField::new('category', 'Catégorie')
                ->setFormTypeOption('query_builder', function (FinCategoryRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('e')
                    ->orderBy('e.name', 'ASC');
                });
            yield DateField::new('date', 'Date')->setColumns(3);
            yield NumberField::new('amount', 'Montant')->setNumDecimals(2);
            yield EnumField::new('payMode', 'Mode Paiement')->setEnum(PayModeEnum::class)->setColumns(3);
            yield TextField::new('docNumber', 'Nº Document');
            yield TextareaField::new('notes', 'Notes')->setColumns(9);
        }
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        if (empty($this->bilan)) {
            return $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
            $queryBuilder
                ->orderBy('entity.date', Criteria::DESC)
            ;
        }

        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $queryBuilder
            ->andWhere('entity.finBilan = :bilan')->setParameter('bilan', $this->bilan)
            ->orderBy('entity.date', Criteria::DESC)
        ;
    }
}
