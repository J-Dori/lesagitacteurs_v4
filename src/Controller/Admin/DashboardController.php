<?php

namespace App\Controller\Admin;

use App\Entity\Site\Play;
use App\Entity\Site\Team;
use App\Entity\Site\Actor;
use App\Entity\Site\Contact;
use App\Entity\EasyPage\Page;
use App\Entity\Site\PlayGallery;
use App\Entity\Site\ContactSocial;
use App\Entity\Site\PlayActorRole;
use App\Repository\PlayRepository;
use App\Entity\Financial\FinIncome;
use App\Entity\Financial\FinExpense;
use App\Entity\Financial\FinCategory;
use App\Repository\PlayGalleryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Financial\FinIncomeRepository;
use App\Repository\Financial\FinExpenseRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Adeliom\EasyAdminUserBundle\Controller\Admin\EasyAdminUserTrait;
use App\Entity\Financial\FinBank;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DashboardController extends AbstractDashboardController
{
    use EasyAdminUserTrait;

    public function __construct(
        private ParameterBagInterface $parameterBag,
        private PlayRepository $playRepository,
        private PlayGalleryRepository $playGalleryRepository,
        private FinIncomeRepository $income,
        private FinExpenseRepository $expense,
    )
    {}

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $play = $this->playRepository->getPlayStatusUpFront();
        $playUpFront = true;
        
        if (empty($play)) {
            $play = $this->playRepository->getLastPlay()[0];
            $playUpFront = false;
        }

        // Admin User Dashboard page
        if ($this->isGranted('ROLE_AMIN')) {
            $gallery = $this->playGalleryRepository->getGalleryByPositionOrder($play, 'ASC');
            return $this->render('admin/index.html.twig', [
                'play' => $play,
                'playUpFront' => $playUpFront,
                'gallery' => $gallery,
            ]);
        }

        // Financial Dashboard page
        $incomes = $this->income->findBy(['play' => $play], ['date' => 'DESC']);
        $expenses = $this->expense->findBy(['play' => $play], ['date' => 'DESC']);

        return $this->render('admin/index_financial.html.twig', [
            'play' => $play,
            'incomes' => $incomes,
            'expenses' => $expenses,
        ]);
        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<object data="/public/upload/systeme/logo-svg.svg"
            width="200"
            height="50"
            type="image/svg+xml">
        
        <img src="/public/upload/systeme/logo-png.png"
            alt="logo" style="width:200px" />
        
        </object>');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Page Internet', 'fa fa-home', 'https://lesagitacteurs.fr')->setLinkTarget('blanc')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-table-columns');
        yield MenuItem::linkToRoute('Médiathèque', 'fa fa-picture-o', 'media.index')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('easy.page.admin.menu.pages', 'fa fa-file-alt', Page::class)->setPermission('ROLE_ADMIN');
        
        // PLAY
        yield MenuItem::section('Données des Pièces')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Pièces', 'fa fa-film', Play::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Rôles', 'fa fa-person-through-window', PlayActorRole::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Galerie', 'fa fa-camera-retro', PlayGallery::class)->setPermission('ROLE_ADMIN');

        // MEMBERS
        yield MenuItem::section('L\'équipe')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Acteurs', 'fa fa-users', Actor::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Membres', 'fa fa-people-roof', Team::class)->setPermission('ROLE_ADMIN');

        // Contacts
        yield MenuItem::section('Contacts')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Liste de Contacts', 'fa fa-address-card', Contact::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Salle/Réseaux sociaux', 'fa fa-thumbs-up', ContactSocial::class)->setEntityId(1)->setAction(Action::EDIT)->setPermission('ROLE_ADMIN');

        // Users
        yield MenuItem::section('Utilisateurs')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('easy_admin_user.users', 'fas fa-users-cog', $this->parameterBag->get('easy_admin_user.user_class'))->setPermission('ROLE_ADMIN');

        // Financial
        yield MenuItem::section('Gestion Financière')->setPermission('ROLE_EDITOR');
        yield MenuItem::linkToCrud('Dépenses', 'fa fa-euro text-danger', FinExpense::class)->setPermission('ROLE_EDITOR');
        yield MenuItem::linkToCrud('Revenues', 'fa fa-cart-arrow-down text-success', FinIncome::class)->setPermission('ROLE_EDITOR');
        yield MenuItem::linkToCrud('Catégories', 'fa fa-list-ul', FinCategory::class)->setPermission('ROLE_EDITOR');
        yield MenuItem::linkToCrud('Banque', 'fa fa-university', FinBank::class)->setPermission('ROLE_EDITOR');
        
    }
}
