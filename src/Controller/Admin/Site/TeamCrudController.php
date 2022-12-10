<?php

namespace App\Controller\Admin\Site;

use App\Entity\Site\Team;
use App\Trait\ObjectStateEnum;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Collections\Criteria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use Adeliom\EasyFieldsBundle\Admin\Field\EnumField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;

class TeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Team::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@EasyMedia/form/easy-media.html.twig')

            ->setPageTitle(Crud::PAGE_INDEX, 'site.team.crud.title.page.'.Crud::PAGE_INDEX)
            ->setPageTitle(Crud::PAGE_EDIT, '%entity_as_string%')
            ->setPageTitle(Crud::PAGE_NEW, 'site.team.crud.title.page.'.Crud::PAGE_NEW)
            ->setPageTitle(Crud::PAGE_DETAIL, 'site.team.crud.title.page.'.Crud::PAGE_DETAIL)
            ->setEntityLabelInSingular('site.team.crud.label.page.singular')
            ->setEntityLabelInPlural('site.team.crud.label.page.plural')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addPanel('Informations personnelles')->setCssClass('col-md-6');
        yield TextField::new('firstname', 'site.team.field.firstname')->setColumns(4);
        yield TextField::new('lastname', 'site.team.field.lastname')->setColumns(7);
        yield FormField::addRow();
        yield TelephoneField::new('phone', 'site.team.field.phone')->setColumns(4);
        yield EmailField::new('email', 'site.team.field.email')->setColumns(7);
        yield FormField::addRow();
        yield EasyMediaField::new('image', 'site.team.field.image')->setColumns(11)->hideOnIndex()
            ->setFormTypeOption("restrictions_uploadTypes", ["image/*"])
            ->setFormTypeOption("restrictions_uploadSize", 2.0)
            ->setFormTypeOption("hideExt", ["svg"])
            ->setHelp('Taille du fichier inférieur à 2 Mo');

        yield FormField::addPanel('Détails du membre')->setCssClass('col-md-6');
        yield TextField::new('role', 'site.team.field.role')->setColumns(6)
            ->setHelp('Limitée à 100 caractères');
        yield IntegerField::new('roleOrder', 'site.team.field.roleOrder')->setColumns(2);
        yield EnumField::new('state', 'site.team.field.state')->setEnum(ObjectStateEnum::class)->setRequired(true)->setColumns(4);
        yield FormField::addRow();
        yield TextEditorField::new('description', 'site.team.field.description')->hideOnIndex()->setColumns(12)->setHelp('Limitée à 255 caractères');
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $queryBuilder
            ->orderBy('entity.roleOrder', Criteria::ASC)
        ;
    }

}
