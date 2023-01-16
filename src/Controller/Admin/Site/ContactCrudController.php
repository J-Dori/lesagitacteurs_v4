<?php

namespace App\Controller\Admin\Site;

use App\Entity\Site\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class ContactCrudController extends AbstractCrudController
{
    
    public function __construct(private readonly ContactRepository $repo)
    {}

    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@EasyMedia/form/easy-media.html.twig')

            ->setPageTitle(Crud::PAGE_INDEX, 'site.contact.crud.title.page.'.Crud::PAGE_INDEX)
            ->setPageTitle(Crud::PAGE_EDIT, 'site.contact.crud.title.page.'.Crud::PAGE_EDIT)
            ->setPageTitle(Crud::PAGE_NEW, 'site.contact.crud.title.page.'.Crud::PAGE_NEW)
            ->setPageTitle(Crud::PAGE_DETAIL, 'site.contact.crud.title.page.'.Crud::PAGE_DETAIL)
            ->setEntityLabelInSingular('site.contact.crud.label.page.singular')
            ->setEntityLabelInPlural('site.contact.crud.label.page.plural')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        if ($pageName === Crud::PAGE_NEW || $pageName === Crud::PAGE_EDIT) {
            yield BooleanField::new('enabled', 'site.contact.field.enabled')->renderAsSwitch(true);
        }
        else {
            yield BooleanField::new('enabled', 'site.contact.field.enabled')->renderAsSwitch(false);
        }
    
        yield FormField::addRow();
        yield TextField::new('firstname', 'site.contact.field.firstname')->setColumns('col-md-2 col-sm-6');
        yield TextField::new('lastname', 'site.contact.field.lastname')->setColumns('col-md-3 col-sm-6');
        yield FormField::addRow();
        yield TextField::new('address', 'site.contact.field.address');
        yield TextField::new('zipCode', 'site.contact.field.zipCode')->setColumns('col-md-2 col-sm-6');
        yield TextField::new('city', 'site.contact.field.city')->setColumns('col-md-3 col-sm-6');
        yield FormField::addRow();
        yield TextField::new('mobilePhone', 'site.contact.field.phone')->setColumns('col-md-2 col-sm-4')->setHelp('Ex : + 33 6 xx xx xx xx');
        yield TextField::new('email', 'site.contact.field.email')->setColumns('col-md-4 col-sm-8');
        
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

}
