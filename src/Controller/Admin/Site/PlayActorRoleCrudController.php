<?php

namespace App\Controller\Admin\Site;

use App\Trait\ObjectStateEnum;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Site\PlayActorRole;
use Doctrine\Common\Collections\Criteria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use Adeliom\EasyFieldsBundle\Admin\Field\EnumField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Adeliom\EasyFieldsBundle\Admin\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlayActorRoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PlayActorRole::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@EasyMedia/form/easy-media.html.twig')

            ->setPageTitle(Crud::PAGE_INDEX, 'site.play_roles.crud.title.page.'.Crud::PAGE_INDEX)
            ->setPageTitle(Crud::PAGE_EDIT, '%entity_as_string%')
            ->setPageTitle(Crud::PAGE_NEW, 'site.play_roles.crud.title.page.'.Crud::PAGE_NEW)
            ->setPageTitle(Crud::PAGE_DETAIL, 'site.play_roles.crud.title.page.'.Crud::PAGE_DETAIL)
            ->setEntityLabelInSingular('site.play_roles.crud.label.page.singular')
            ->setEntityLabelInPlural('site.play_roles.crud.label.page.plural')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('playAndYear', 'site.play_roles.field.play')->setColumns(4)->onlyOnIndex();
        yield AssociationField::new('play', 'site.play_roles.field.play')->setColumns(4)->hideOnIndex();
        
        yield AssociationField::new('actor', 'site.play_roles.field.actor')->setColumns(4);
        yield TextField::new('name', 'site.play_roles.field.name')->setColumns(4);
        yield EnumField::new('state', 'site.play_roles.field.state')->setEnum(ObjectStateEnum::class)->setRequired(true)->setColumns(4);
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $queryBuilder
            ->join('entity.play', 'p')
            ->join('entity.actor', 'a')
            ->addOrderBy('p.year', Criteria::DESC)
            ->addOrderBy('p.name', Criteria::ASC)
            ->addOrderBy('a.firstname', Criteria::ASC)
        ;
    }

}
