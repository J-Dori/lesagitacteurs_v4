<?php

declare(strict_types=1);

namespace App\DataFixtures\Pages;

use App\Entity\EasyPage\Page;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Helpers\MediaHelpers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpKernel\KernelInterface;
use Adeliom\EasyMediaBundle\Service\EasyMediaManager;
use Adeliom\EasyCommonBundle\Enum\ThreeStateStatusEnum;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class HomePageFixtures extends Fixture implements FixtureGroupInterface
{
    use MediaHelpers;

    public const ABOUT_US = 'about-us';
    public const TEAM = 'team';
    public const PLAY_INDEX = 'play_index';
    public const BLOG = 'blog';
    public const CONTACT = 'contact';

    public const METRO = 'metro-2008-page';
    public const PROCES = 'proces-2010-page';
    public const RICKY = 'ricky-2011-page';
    public const TELE_VIVANTE = 'tele-vivante-2013-page';
    public const PHILEAS_FOGG = 'phileas-fogg-2013-page';
    public const TOUT_LE_MONDE = 'tout-le-monde-2014-page';
    public const PINOCCHIOS = 'pinocchios-2015-page';
    public const CHARLES_PERRAULT = 'charles-perrault-2016-page';
    public const CANTERVILLE = 'canterville-2017-page';
    public const ULYSSE = 'ulysse-2018-page';
    public const ALICE = 'alice-2019-page';
    public const CABARETTO = 'cabaretto-2021-page';
    public const PETER_PAN = 'peter-pan-2022-page';
    
    public function __construct(private KernelInterface $kernel, private EasyMediaManager $easyMediaManager)
    { }

    public function load(ObjectManager $manager): void
    {
        $items = $this->addItems();

        foreach ($items as $key => $item) {
            $page = new Page();
            $page->setName($item['name']);
            $page->setSlug($item['slug']);
            $page->setState((string) ThreeStateStatusEnum::PUBLISHED());
            $manager->persist($page);
            $this->addReference($item['ref'], $page);
            $manager->flush();
            if (isset($item['items'])) { 
                $childItems = $item['items'];
                $this->addChildItems($childItems, $page, $manager);
            }
        }

        $this->createMedia('logo', 'logo.png');

    }

    public function addItems(): array
    {
        return [
            [
                'name' => 'Qui sommes-nous ?',
                'slug' => 'qui-sommes-nous',
                'ref' => self::ABOUT_US,
            ],
            [
                'name' => 'Notre équipe',
                'slug' => 'notre-equipe',
                'ref' => self::TEAM,
            ],
            [
                'name' => 'Nos Pièces',
                'slug' => 'nos-pieces',
                'ref' => self::PLAY_INDEX,
                'items' => $this->addPlayItems(),
            ],
            [
                'name' => 'Actualités',
                'slug' => 'blog',
                'ref' => self::BLOG,
            ],
            [
                'name' => 'Contact',
                'slug' => 'contact',
                'ref' => self::CONTACT,
            ],
        ];
    }


    public function addPlayItems(): array
    {
        return [
            [
                'name' => 'Le métro mé pas tro',
                'slug' => 'le-metro-me-pas-tro',
                'ref' => self::METRO,
            ],
            [
                'name' => 'Le procès du Loup',
                'slug' => 'le-proces-du-loup',
                'ref' => self::PROCES,
            ],
            [
                'name' => 'Ricky Pompon',
                'slug' => 'ricky-pompon',
                'ref' => self::RICKY,
            ],
            [
                'name' => 'La soirée télé vivante',
                'slug' => 'la-soiree-tele-vivante',
                'ref' => self::TELE_VIVANTE,
            ],
            [
                'name' => 'Les aventures de Philéas Fogg',
                'slug' => 'les-aventures-de-phileas-fogg',
                'ref' => self::PHILEAS_FOGG,
            ],
            [
                'name' => 'Comme tout le monde',
                'slug' => 'comme-tout-le-monde',
                'ref' => self::TOUT_LE_MONDE,
            ],
            [
                'name' => 'Les aventures de Pinocchios!',
                'slug' => 'les-aventures-de-pinocchios',
                'ref' => self::PINOCCHIOS,
            ],
            [
                'name' => 'Qui a tué Charles Perrault?',
                'slug' => 'qui-a-tue-charles-perrault',
                'ref' => self::CHARLES_PERRAULT,
            ],
            [
                'name' => 'Le Fantôme de Canterville',
                'slug' => 'le-fantôme-de-canterville',
                'ref' => self::CANTERVILLE,
            ],
            [
                'name' => 'L\'Odyssée d\'Ulysse',
                'slug' => 'l-odyssee-d-ulysse',
                'ref' => self::ULYSSE,
            ],
            [
                'name' => 'Alice et autres merveilles',
                'slug' => 'alice-et-autres-merveilles',
                'ref' => self::ALICE,
            ],
            [
                'name' => 'Cabaretto',
                'slug' => 'cabaretto',
                'ref' => self::CABARETTO,
            ],
            [
                'name' => 'Peter Pan',
                'slug' => 'peter-pan',
                'ref' => self::PETER_PAN,
            ],
        ];
    }

    private function addChildItems(array $childItems, Page $parent, ObjectManager $manager): void
    {
        foreach ($childItems as $key => $item) {
            $childPage = new Page();
            $childPage->setName($item['name']);
            $childPage->setSlug($item['slug']);
            $childPage->setParent($parent);
            $childPage->setState((string) ThreeStateStatusEnum::PUBLISHED());
            $manager->persist($childPage);
            $this->addReference($item['ref'], $childPage);
            $manager->flush();
            if (isset($item['items'])) {
                $this->addItems($item['items'], $childItems, $parent, $manager);
            }
            $manager->persist($childPage);
        }
    }

    public static function getGroups(): array
    {
        return ['page'];
    }
}
