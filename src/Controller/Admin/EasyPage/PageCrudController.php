<?php

declare(strict_types=1);

namespace App\Controller\Admin\EasyPage;

use App\Entity\EasyPage\Page;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Provider\AdminContextProvider;
use Adeliom\EasyPageBundle\Controller\PageCrudController as BasePageCrudController;

class PageCrudController extends BasePageCrudController
{
    public function __construct(
        private readonly AdminContextProvider $adminContextProvider
    ){}

    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $context = $this->adminContextProvider->getContext();
        $subject = $context->getEntity();

        yield FormField::addTab('easy.page.admin.panel.information');
        yield IdField::new('id')->hideOnForm();
        yield FormField::addPanel('Page')->addCssClass('col-4');
        yield from $this->informationsFields($pageName, $subject);
        yield from $this->publishFields($pageName, $subject);
        yield FormField::addTab('Autres configurations');
        yield from $this->seoFields($pageName, $subject);
        yield from $this->metadataFields($pageName, $subject);
    }

    public function informationsFields(string $pageName, $subject): iterable
    {
        yield TextField::new('name', 'easy.page.admin.field.name')
            ->setRequired(true)
            ->setColumns(12);
        yield FormField::addRow();
        yield AssociationField::new('parent', 'easy.page.admin.field.parent')
            ->setQueryBuilder(static function (QueryBuilder $queryBuilder) use ($subject) {
                $rootAllias = $queryBuilder->getAllAliases()[0];
                if ($subject->getPrimaryKeyValue()) {
                    $queryBuilder->andWhere(sprintf('%s.id != :currentID', $rootAllias))
                        ->setParameter('currentID', $subject->getPrimaryKeyValue());
                }

                return $queryBuilder;
            })
            ->setColumns(12);
    }

    public function metadataFields(string $pageName, $subject): iterable
    {
        yield FormField::addPanel('easy.page.admin.panel.metadatas')->addCssClass('col-4');
        yield SlugField::new('slug', 'easy.page.admin.field.slug')
            ->setRequired(true)
            ->hideOnIndex()
            ->setTargetFieldName('name')
            ->setUnlockConfirmationMessage('easy.page.admin.field.slug_edit')
            ->setColumns(12)
            ->setHelp("<div><span>Remplissage automatique.<br>Le texte qui sera affiché dans la barre d'adresse du navigateur.<br>Si vous souhaitez le modifier, remplacez le lettres accentuées (é = e) et les apostrophes par un hiffen '-'.</span></div>");

        yield TextField::new('action', 'easy.page.admin.field.action')
            ->hideOnIndex()
            ->setHelp('easy.page.admin.field.action_help')
            ->setColumns(12);
    }
}
