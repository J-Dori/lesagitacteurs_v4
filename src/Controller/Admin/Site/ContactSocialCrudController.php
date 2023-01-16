<?php

namespace App\Controller\Admin\Site;

use App\Entity\Site\ContactSocial;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ContactSocialRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class ContactSocialCrudController extends AbstractCrudController
{
    public function __construct(private readonly ContactSocialRepository $repo)
    {}

    public static function getEntityFqcn(): string
    {
        return ContactSocial::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@EasyMedia/form/easy-media.html.twig')

            ->setPageTitle(Crud::PAGE_INDEX, 'site.social.crud.title.page.'.Crud::PAGE_INDEX)
            ->setPageTitle(Crud::PAGE_EDIT, 'site.social.crud.title.page.'.Crud::PAGE_EDIT)
            ->setPageTitle(Crud::PAGE_NEW, 'site.social.crud.title.page.'.Crud::PAGE_NEW)
            ->setPageTitle(Crud::PAGE_DETAIL, 'site.social.crud.title.page.'.Crud::PAGE_DETAIL)
            ->setEntityLabelInSingular('site.social.crud.label.page.singular')
            ->setEntityLabelInPlural('site.social.crud.label.page.plural')
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions->remove(Crud::PAGE_INDEX, Action::NEW);
        $actions->remove(Crud::PAGE_INDEX, Action::DELETE);
        $actions->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE);
        $actions->add(Crud::PAGE_EDIT, Action::DELETE);
        return $actions;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Salle de Spectacle'),
            TextField::new('name', 'site.social.field.name'),
            TextField::new('address', 'site.contact.field.address'),
            TextField::new('zipCode', 'site.contact.field.zipCode')->setColumns('col-md-2 col-sm-6'),
            TextField::new('city', 'site.contact.field.city')->setColumns('col-md-3 col-sm-6'),
            FormField::addRow(),
            TextField::new('mobilePhone', 'site.contact.field.phone')->setColumns('col-md-2 col-sm-4')->setHelp('Ex : + 33 6 xx xx xx xx'),
            TextField::new('email', 'site.contact.field.email')->setColumns('col-md-4 col-sm-8'),
            FormField::addRow(),
            TextField::new('mapLink', 'site.social.field.mapLink')->setHelp('Lien pour afficher l\'image de Google Maps')->hideOnIndex(),

            FormField::addTab('Réseaux Sociaux'),
            TextField::new('facebook', 'site.social.field.facebook')->hideOnIndex(),
            TextField::new('youtube', 'site.social.field.youtube')->hideOnIndex(),
            TextField::new('instagram', 'site.social.field.instagram')->hideOnIndex(),
        ];
    }
   

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance->isEnabled() === true) {
            $this->repo->setAllDisabled();
        }

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance->isEnabled() === true) {
            $this->repo->setAllDisabled();
        }

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->addFlash('error', '<i class="fa-solid fa-triangle-exclamation"></i>&emsp;<span class="text-danger">Impossible de supprimer ces données.</span> Vous pouvez uniquement les modifier !');
    }
 
}
