<?php

namespace App\Controller;

use App\Entity\Site\Play;
use App\Entity\Site\Contact;
use App\Entity\Site\ContactSocial;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    public function __construct
    (
        private EntityManagerInterface $em,
    ){}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $playBanner = $this->em->getRepository(Play::class)->getPlayStatusUpFront();
        if (empty($playBanner)) {
            $playBanner = $this->em->getRepository(Play::class)->getLastPlay();
        }

        return $this->render('home/index.html.twig', [
            'playBanner' => $playBanner,
            'contactSocial' => $this->em->getRepository(ContactSocial::class)->getEnabledContact(),
            'plays' => $this->em->getRepository(Play::class)->getAllStatusClosed(),
        ]);
    }

    #[Route('/confidentialite', name: 'app_policy')]
    public function policy(): Response
    {
        return $this->render('home/privacy.html.twig', [
            'contact' => $this->em->getRepository(Contact::class)->getEnabledContact(),
        ]);
        //return $this->redirect($this->generateUrl('easy_page_index', $params));
    }

}
