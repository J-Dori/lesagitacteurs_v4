<?php

namespace App\Controller\Admin;

use App\Entity\EasyPage\Page;
use App\Entity\Financial\FinBilan;
use App\Entity\Financial\FinBank;
use App\Entity\Financial\FinCategory;
use App\Entity\Financial\FinIncome;
use App\Entity\Financial\FinExpense;
use App\Entity\Site\Actor;
use App\Entity\Site\Contact;
use App\Entity\Site\ContactSocial;
use App\Entity\Site\Play;
use App\Entity\Site\PlayActorRole;
use App\Entity\Site\PlayGallery;
use App\Entity\Site\Team;
use App\Repository\PlayRepository;
use App\Repository\PlayGalleryRepository;
use App\Repository\Financial\FinBankRepository;
use App\Repository\Financial\FinBilanRepository;
use App\Repository\Financial\FinIncomeRepository;
use App\Repository\Financial\FinExpenseRepository;
use Adeliom\EasyAdminUserBundle\Controller\Admin\EasyAdminUserTrait;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    use EasyAdminUserTrait;

    private $bilan = null;
    private $incomes = null;
    private $expenses = null;

    public function __construct(
        private ParameterBagInterface $parameterBag,
        private PlayRepository $playRepository,
        private PlayGalleryRepository $playGalleryRepository,
        private FinIncomeRepository $finIncomeRepository,
        private FinExpenseRepository $finExpenseRepository,
        private FinBilanRepository $finBilanRepository,
        private FinBankRepository $finBankRepository,
    )
    {
        $this->bilan = $this->finBilanRepository->getActive();
        $this->incomes = $this->finIncomeRepository->getListByBilanActive();
        $this->expenses = $this->finExpenseRepository->getListByBilanActive();
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $play = $this->playRepository->getPlayStatusUpFront();
        $playBanner = true;
        
        if (empty($play)) {
            $play = $this->playRepository->getLastPlay()[0];
            $playBanner = false;
        }

        // Admin User Dashboard page
        if ($this->isGranted('ROLE_ADMINISTRATOR')) {
            $gallery = $this->playGalleryRepository->getGalleryByPositionOrder($play, 'ASC');
            return $this->render('admin/dashboard/index.html.twig', [
                'play' => $play,
                'playBanner' => $playBanner,
                'gallery' => $gallery,
                'bilan' => $this->bilan,
                'balance' => $this->finBankRepository->getCurrentBalance(),
                'incomes' => $this->incomes,
                'expenses' => $this->expenses,
            ]);
        }

        // Financial Dashboard page
        return $this->render('admin/dashboard/index_financial.html.twig', [
            'bilan' => $this->bilan,
            'balance' => $this->finBankRepository->getCurrentBalance(),
            'incomes' => $this->incomes,
            'expenses' => $this->expenses,
        ]);
        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/images/default/logo.png"
            alt="Les Agit\'acteurs" style="width:200px" />');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateFormat('dd-MM-Y')
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Page Internet', 'fa fa-home', 'app_home')->setLinkTarget('blanc')->setPermission('ROLE_ADMIN');
        //yield MenuItem::linkToUrl('Page Internet', 'fa fa-home', 'https://lesagitacteurs.fr')->setLinkTarget('blanc')->setPermission('ROLE_ADMIN');
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
        yield MenuItem::linkToCrud('Dépenses', 'fa fa-euro text-danger', FinExpense::class)
            ->setBadge($this->bilan ? count($this->expenses) : '', 'danger')
            ->setPermission('ROLE_EDITOR');
        yield MenuItem::linkToCrud('Recettes', 'fa fa-cart-arrow-down text-success', FinIncome::class)
            ->setBadge($this->bilan ? count($this->incomes) : '', 'success')
            ->setPermission('ROLE_EDITOR');
        yield MenuItem::linkToCrud('Bilan', 'fa fa-chart-line', FinBilan::class)
            ->setBadge($this->bilan ? $this->bilan->getYear() : '', 'secondary')
            ->setPermission('ROLE_EDITOR');
        yield MenuItem::linkToCrud('Catégories', 'fa fa-list-ul', FinCategory::class)->setPermission('ROLE_EDITOR');
        yield MenuItem::linkToCrud('Comptes Bancaires', 'fa fa-university', FinBank::class)->setPermission('ROLE_EDITOR');
        
    }
}
