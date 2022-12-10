<?php

declare(strict_types=1);

namespace App\Controller\Admin\EasyAdminUser;

use App\Entity\EasyAdmin\User;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Collections\Criteria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use Adeliom\EasyAdminUserBundle\Controller\Admin\EasyAdminUserCrudController as BaseEasyAdminUserCrudController;

class EasyAdminUserCrudController extends BaseEasyAdminUserCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions = parent::configureActions($actions);
        $currentUser = $this->getUser();

        $actions
            ->remove(Crud::PAGE_DETAIL, 'impersonate')
            ->remove(Crud::PAGE_EDIT, 'impersonate');

        $actions->update(Crud::PAGE_INDEX, Action::DELETE, static function (Action $action) use ($currentUser): Action {
            $action->displayIf(static fn (User $entity): bool => $currentUser->getUserIdentifier() !== $entity->getEmail());
            
            return $action;
        });
      
        
        $actions->update(Crud::PAGE_DETAIL, Action::DELETE, static function (Action $action) use ($currentUser): Action {
            $action->displayIf(static fn (User $entity): bool => $currentUser->getUserIdentifier() !== $entity->getEmail());

            return $action;
        });

        return $actions;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $queryBuilder
            ->andWhere('entity.roles NOT LIKE :role')
            ->setParameter('role', '%'.User::SUPER_ADMIN.'%')
            ->addOrderBy('entity.lastname', Criteria::ASC)
        ;
    }

}
