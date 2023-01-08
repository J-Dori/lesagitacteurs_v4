<?php

namespace App\Controller\Admin\Site;

use App\Entity\Site\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    
    public function __construct(private readonly ContactRepository $repo)
    {}

    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */

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
