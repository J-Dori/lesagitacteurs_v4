<?php

namespace App\Controller\Admin\Site;

use Doctrine\ORM\QueryBuilder;
use App\Entity\Site\PlayGallery;
use Doctrine\Common\Collections\Criteria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Adeliom\EasyMediaBundle\Admin\Field\EasyMediaField;
use Adeliom\EasyFieldsBundle\Admin\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlayGalleryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PlayGallery::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@EasyMedia/form/easy-media.html.twig')

            ->setPageTitle(Crud::PAGE_INDEX, 'site.play_gallery.crud.title.page.'.Crud::PAGE_INDEX)
            ->setPageTitle(Crud::PAGE_EDIT, 'site.play_gallery.crud.title.page.'.Crud::PAGE_EDIT)
            ->setPageTitle(Crud::PAGE_NEW, 'site.play_gallery.crud.title.page.'.Crud::PAGE_NEW)
            ->setPageTitle(Crud::PAGE_DETAIL, 'site.play_gallery.crud.title.page.'.Crud::PAGE_DETAIL)
            ->setEntityLabelInSingular('site.play_gallery.crud.label.page.singular')
            ->setEntityLabelInPlural('site.play_gallery.crud.label.page.plural')
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE);
        $actions->add(Crud::PAGE_EDIT, Action::DELETE);
        $actions->update(Crud::PAGE_INDEX, Action::NEW,
             fn (Action $action) => $action->setLabel('Ajouter image'));
        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {
        if ($pageName == Crud::PAGE_INDEX) {
            yield TextField::new('play.getYearAndName', 'site.play_gallery.field.play');
            yield EasyMediaField::new('image', 'site.play_gallery.field.image')
            ->setTemplatePath('admin/field/image.html.twig');
        } else {
            yield AssociationField::new('play', 'site.play_gallery.field.play');
            yield EasyMediaField::new('image', 'site.play_gallery.field.image')->setColumns(12)->hideOnIndex()
                ->setFormTypeOption("restrictions_uploadTypes", ["image/*"])
                ->setFormTypeOption("restrictions_uploadSize", 2.0)
                ->setFormTypeOption("hideExt", ["svg"])
                ->setHelp('<div><p>Taille du fichier inférieur à 2 Mo - Utilisez un <a href="https://imagecompressor.com/" target="_blanc">compresseur d\'images</a></p><p>Nombre maximum d\'images : 10</p></div>');
        }
        yield NumberField::new('position', 'site.play_gallery.field.position')->setColumns(1)
            ->setHelp('<div><p>Si vide, la valeur s\'incrémente automatiquement</p></div>');
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $queryBuilder
            ->join('entity.play', 'p')
            ->addOrderBy('p.year', Criteria::DESC)
            ->addOrderBy('p.name', Criteria::ASC)
            ->addOrderBy('entity.position', Criteria::DESC)
        ;
    }

}
