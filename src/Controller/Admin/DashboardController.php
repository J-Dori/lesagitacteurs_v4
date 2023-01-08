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
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DashboardController extends AbstractDashboardController
{
    use EasyAdminUserTrait;

    private ParameterBagInterface $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
       return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Les Agit\'acteurs');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Médiathèque', 'fa fa-picture-o', 'media.index')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('easy.page.admin.menu.pages', 'fa fa-file-alt', Page::class);
        
        // PLAY
        yield MenuItem::section('Données des Pièces');
        yield MenuItem::linkToCrud('Pièces', 'fa fa-film', Play::class);
        yield MenuItem::linkToCrud('Piéces - Rôles', 'fa fa-person-through-window', PlayActorRole::class);

        // MEMBERS
        yield MenuItem::section('L\'équipe');
        yield MenuItem::linkToCrud('Acteurs', 'fa fa-users', Actor::class);
        yield MenuItem::linkToCrud('Membres', 'fa fa-people-roof', Team::class);

        // Contacts
        yield MenuItem::section('Contacts');
        yield MenuItem::linkToCrud('Liste de Contacts', 'fa fa-contact', Contact::class);
        yield MenuItem::linkToCrud('Réseaux sociaux', 'fa fa-social', ContactSocial::class);

        // Users
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::linkToCrud('easy_admin_user.users', 'fas fa-users-cog', $this->parameterBag->get('easy_admin_user.user_class'))->setPermission('ROLE_ADMIN');
    }
}
