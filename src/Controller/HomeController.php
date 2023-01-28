<?php

namespace App\Controller;

use App\Entity\Site\Play;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    public function __construct
    (
        private EntityManagerInterface $em,
    ){}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'plays' => $this->em->getRepository(Play::class)->getAllPublishedOrderBy(),
        ]);
    }

    #[Route('/confidentialite', name: 'app_policy')]
    public function policy(): Response
    {
        $params = ['slugs' => ''];

        return $this->redirect($this->generateUrl('easy_page_index', $params));
    }

}
