<?php

namespace App\Controller\Admin;

use App\Entity\Site\Play;
use App\Entity\Site\Team;
use App\Entity\Site\Actor;
use App\Entity\EasyPage\Page;
use App\Entity\Site\PlayActorRole;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Adeliom\EasyAdminUserBundle\Controller\Admin\EasyAdminUserTrait;
use App\Entity\Site\Contact;
use App\Entity\Site\ContactSocial;
use App\Entity\Site\PlayGallery;
use App\Repository\PlayGalleryRepository;
use App\Repository\PlayRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DashboardController extends AbstractDashboardController
{
    use EasyAdminUserTrait;

    public function __construct(
        private ParameterBagInterface $parameterBag,
        private PlayRepository $playRepository,
        private PlayGalleryRepository $playGalleryRepository
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
        $gallery = $this->playGalleryRepository->getGalleryByPositionOrder($play, 'ASC');

        return $this->render('admin/index.html.twig', [
            'play' => $play,
            'playUpFront' => $playUpFront,
            'gallery' => $gallery,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<object data="/public/logo/logo.svg"
            width="200"
            height="50"
            type="image/svg+xml">
        
        <img src="/public/logo/logo.png"
            alt="logo" style="width:200px" />
        
        </object>');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Page Internet', 'fa fa-home', 'https://lesagitacteurs.fr')->setLinkTarget('blanc');
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-table-columns');
        yield MenuItem::linkToRoute('Médiathèque', 'fa fa-picture-o', 'media.index')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('easy.page.admin.menu.pages', 'fa fa-file-alt', Page::class);
        
        // PLAY
        yield MenuItem::section('Données des Pièces');
        yield MenuItem::linkToCrud('Pièces', 'fa fa-film', Play::class);
        yield MenuItem::linkToCrud('Rôles', 'fa fa-person-through-window', PlayActorRole::class);
        yield MenuItem::linkToCrud('Galerie', 'fa fa-camera-retro', PlayGallery::class);

        // MEMBERS
        yield MenuItem::section('L\'équipe');
        yield MenuItem::linkToCrud('Acteurs', 'fa fa-users', Actor::class);
        yield MenuItem::linkToCrud('Membres', 'fa fa-people-roof', Team::class);

        // Contacts
        yield MenuItem::section('Contacts');
        yield MenuItem::linkToCrud('Liste de Contacts', 'fa fa-address-card', Contact::class);
        yield MenuItem::linkToCrud('Salle/Réseaux sociaux', 'fa fa-thumbs-up', ContactSocial::class)->setEntityId(1)->setAction(Action::EDIT);

        // Users
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('easy_admin_user.users', 'fas fa-users-cog', $this->parameterBag->get('easy_admin_user.user_class'))->setPermission('ROLE_ADMIN');
    }
}
