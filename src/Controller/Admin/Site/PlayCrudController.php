<?php

namespace App\Controller\Admin\Site;

use App\Entity\Site\Play;
use App\Trait\PlayStatusEnum;
use App\Trait\ObjectStateEnum;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Collections\Criteria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use Adeliom\EasyFieldsBundle\Admin\Field\EnumField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use App\Form\PlayActorRoleType;
use App\Form\PlayGalleryType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class PlayCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Play::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@EasyMedia/form/easy-media.html.twig')

            ->setPageTitle(Crud::PAGE_INDEX, 'site.play.crud.title.page.'.Crud::PAGE_INDEX)
            ->setPageTitle(Crud::PAGE_EDIT, '%entity_as_string%')
            ->setPageTitle(Crud::PAGE_NEW, 'site.play.crud.title.page.'.Crud::PAGE_NEW)
            ->setPageTitle(Crud::PAGE_DETAIL, 'site.play.crud.title.page.'.Crud::PAGE_DETAIL)
            ->setEntityLabelInSingular('site.play.crud.label.page.singular')
            ->setEntityLabelInPlural('site.play.crud.label.page.plural')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('Pièce');
        yield FormField::addPanel('Détails de la pièce')->setCssClass('col-md-9 col-sm-12');
        yield TextField::new('year', 'site.play.field.year')->setColumns(3);
        yield TextField::new('name', 'site.play.field.name')->setColumns(9);
        yield TextEditorField::new('description', 'site.play.field.description')->hideOnIndex()->setColumns(12);
        yield EasyMediaField::new('image', 'site.play.field.image')->setColumns(12)->hideOnIndex()
            ->setFormTypeOption("restrictions_uploadTypes", ["image/*"])
            ->setFormTypeOption("restrictions_uploadSize", 2.0)
            ->setFormTypeOption("hideExt", ["svg"])
            ->setHelp('<div><p>Taille du fichier inférieur à 2 Mo - Utilisez un <a href="https://imagecompressor.com/" target="_blanc">compresseur d\'images</a></p></div>');

        yield FormField::addPanel('Publication')->setCssClass('col-md-3 col-sm-12');
        yield EnumField::new('playStatus', 'site.play.field.playStatus')->setEnum(PlayStatusEnum::class)->setColumns(12);
        yield DateField::new('dateStart', 'site.play.field.dateStart');
        yield DateField::new('dateEnd', 'site.play.field.dateEnd');
        yield EnumField::new('state', 'site.play.field.state')->setEnum(ObjectStateEnum::class)->setRequired(true)->setColumns(12);
        
        yield FormField::addTab('Rôles')->onlyOnForms();
        yield CollectionField::new('playActorRoles', 'Rôles')->setEntryType(PlayActorRoleType::class)->onlyOnForms()
            ->allowAdd()
            ->allowDelete()
            ->setEntryIsComplex()
        ;

        yield FormField::addTab('Galerie');
        yield CollectionField::new('playGalleries', 'Images')->setEntryType(PlayGalleryType::class)->onlyOnForms()
            ->allowAdd()
            ->allowDelete()
            ->setEntryIsComplex()
            ->showEntryLabel()
        ;

    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $queryBuilder
            ->orderBy('entity.year', Criteria::DESC)
            ->addOrderBy('entity.name', Criteria::ASC)
        ;
    }
   
}
