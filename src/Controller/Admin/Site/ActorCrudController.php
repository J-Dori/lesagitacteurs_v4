<?php

namespace App\Controller\Admin\Site;

use App\Entity\Site\Actor;
use App\Trait\ObjectStateEnum;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Collections\Criteria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use Adeliom\EasyFieldsBundle\Admin\Field\EnumField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ActorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actor::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@EasyMedia/form/easy-media.html.twig')

            ->setPageTitle(Crud::PAGE_INDEX, 'site.actor.crud.title.page.'.Crud::PAGE_INDEX)
            ->setPageTitle(Crud::PAGE_EDIT, '%entity_as_string%')
            ->setPageTitle(Crud::PAGE_NEW, 'site.actor.crud.title.page.'.Crud::PAGE_NEW)
            ->setPageTitle(Crud::PAGE_DETAIL, 'site.actor.crud.title.page.'.Crud::PAGE_DETAIL)
            ->setEntityLabelInSingular('site.actor.crud.label.page.singular')
            ->setEntityLabelInPlural('site.actor.crud.label.page.plural')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addPanel('Informations de l\'enfant')->setCssClass('col-md-6');
        yield TextField::new('fullname', 'site.actor.field.fullname')->onlyOnIndex();
        yield TextField::new('firstname', 'site.actor.field.firstname')->setColumns(4)->hideOnIndex();
        yield TextField::new('lastname', 'site.actor.field.lastname')->setColumns(7)->hideOnIndex();
        yield FormField::addRow();
        yield TelephoneField::new('phone', 'site.actor.field.phone')->setColumns(4);
        yield EmailField::new('email', 'site.actor.field.email')->setColumns(7);
        yield FormField::addRow();
        yield EnumField::new('state', 'site.actor.field.state')->setEnum(ObjectStateEnum::class)->setRequired(true)->setColumns(4)->hideOnIndex();

       
        yield FormField::addPanel('Informations du Responsable')->setCssClass('col-md-6');
        yield TextField::new('respFullname', 'site.actor.field.respFullname')->onlyOnIndex();
        yield TextField::new('respFirstname', 'site.actor.field.respFirstname')->setColumns(4)->hideOnIndex();
        yield TextField::new('respLastname', 'site.actor.field.respLastname')->setColumns(7)->hideOnIndex();
        yield FormField::addRow();
        yield TelephoneField::new('respPhone', 'site.actor.field.respPhone')->setColumns(4);
        yield EmailField::new('respEmail', 'site.actor.field.respEmail')->setColumns(7);
        //add list of Roles collections
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $queryBuilder
            ->addOrderBy('entity.firstname', Criteria::ASC)
            ->addOrderBy('entity.lastname', Criteria::ASC)
        ;
    }
}
