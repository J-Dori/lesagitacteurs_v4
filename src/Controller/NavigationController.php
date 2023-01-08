<?php

namespace App\Controller;

use App\Entity\EasyPage\Page;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NavigationController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {}
    
    public function topMenu(): Response
    {
        $pages = $this->manager->getRepository(Page::class)->getMainPages();
        $mainPages = [];
        foreach ($pages as $page) {
            $mainPages[] = [
                'name' => $page->getName(),
                'slug' => $page->getSlug(),
            ];
        }

        return $this->render('navigations/header.html.twig', [
            'mainPages' => $mainPages,
        ]);
    }

    public function contactMenu(): Response
    {
        return $this->render('home/index.html.twig');
    }

    
    public function footerMenu(): Response
    {
        $params = ['slugs' => ''];

        return $this->redirect($this->generateUrl('easy_page_index', $params));
    }



}
