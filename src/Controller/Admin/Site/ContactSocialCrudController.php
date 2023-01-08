<?php

namespace App\Controller\Admin\Site;

use App\Entity\Site\ContactSocial;
use App\Repository\ContactSocialRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactSocialCrudController extends AbstractCrudController
{
    public function __construct(private readonly ContactSocialRepository $repo)
    {}

    public static function getEntityFqcn(): string
    {
        return ContactSocial::class;
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
