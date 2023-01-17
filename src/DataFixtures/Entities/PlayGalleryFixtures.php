<?php

namespace App\DataFixtures\Entities;

use App\Entity\Site\Play;
use App\Trait\ObjectStateEnum;
use App\Entity\Site\PlayGallery;
use App\Entity\Site\PlayActorRole;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use App\DataFixtures\Helpers\MediaHelpers;
use App\DataFixtures\Entities\PlayFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Entities\ActorFixtures;
use Symfony\Component\HttpKernel\KernelInterface;
use Adeliom\EasyMediaBundle\Service\EasyMediaManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PlayGalleryFixtures extends Fixture implements DependentFixtureInterface
{

    use MediaHelpers;
    
    public function __construct(private EntityManagerInterface $manager, private KernelInterface $kernel, private EasyMediaManager $easyMediaManager)
    {}

    public function getDependencies()
    {
        return [PlayFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        dump('*************** LOADING : Galerie des Pièces ***************');

        $arrayData = $this->getData();
        $currentPlay = $arrayData[0]['play'];
        $position = 1;

        foreach ($arrayData as $array) {
            if ($currentPlay !== $array['play']) {
                dump($currentPlay->getName() .' : ' . $position . ' images');
                $position = 1;
                $currentPlay = $array['play'];
            }
            $data = new PlayGallery();
            $data->setPlay($array['play'] ?? null);
            $data->setImage($array['image'] ?? null);
            $data->setPosition($position);
            $manager->persist($data);
            $position++;
        }
        dump($currentPlay->getName() .' : ' . $position . ' images');
        $manager->flush();
    }

     
    public function getData(): array
    {

        $play2008 = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::METRO)->getId());
        $play2010 = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId());
        $play2011 = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::RICKY)->getId());
        $play2013a = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PHILEAS_FOGG)->getId());
        $play2013e = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::TELE_VIVANTE)->getId());
        $play2014 = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::TOUT_LE_MONDE)->getId());
        $play2015 = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PINOCCHIOS)->getId());
        $play2016 = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CHARLES_PERRAULT)->getId());
        $play2017 = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CANTERVILLE)->getId());
        $play2018 = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId());
        $play2019 = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId());
        $play2021 = $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CABARETTO)->getId());
        
        $data = [];

        for ($i=1; $i <=4 ; $i++) { 
            $data[] = [
                "play" => $play2008,
                'image' => $this->createMedia('pieces/2008', $i.'.jpeg')?->getId(),
            ];
        }

        for ($i=1; $i <=7 ; $i++) { 
            $data[] = [
                "play" => $play2010,
                'image' => $this->createMedia('pieces/2010', $i.'.jpeg')?->getId(),
            ];
        }

        for ($i=1; $i <=5 ; $i++) { 
            $data[] = [
                "play" => $play2011,
                'image' => $this->createMedia('pieces/2011', $i.'.jpeg')?->getId(),
            ];
        }

        for ($i=1; $i <=10 ; $i++) { 
            $data[] = [
                "play" => $play2013a,
                'image' => $this->createMedia('pieces/2013-ados', $i.'.jpeg')?->getId(),
            ];
        }

        for ($i=1; $i <=9 ; $i++) { 
            $data[] = [
                "play" => $play2013e,
                'image' => $this->createMedia('pieces/2013-enfants', $i.'.jpeg')?->getId(),
            ];
        }

        for ($i=1; $i <=10 ; $i++) { 
            $data[] = [
                "play" => $play2014,
                'image' => $this->createMedia('pieces/2014', $i.'.jpeg')?->getId(),
            ];
        }

        for ($i=1; $i <=10 ; $i++) { 
            $data[] = [
                "play" => $play2015,
                'image' => $this->createMedia('pieces/2015', $i.'.jpeg')?->getId(),
            ];
        }

        for ($i=1; $i <=16 ; $i++) { 
            $data[] = [
                "play" => $play2016,
                'image' => $this->createMedia('pieces/2016', $i.'.jpeg')?->getId(),
            ];
        }

        for ($i=1; $i <=14 ; $i++) { 
            $data[] = [
                "play" => $play2017,
                'image' => $this->createMedia('pieces/2017', $i.'.jpeg')?->getId(),
            ];
        }

        for ($i=1; $i <=19 ; $i++) { 
            $data[] = [
                "play" => $play2018,
                'image' => $this->createMedia('pieces/2018', $i.'.jpeg')?->getId(),
            ];
        }

        for ($i=1; $i <=4 ; $i++) { 
            $data[] = [
                "play" => $play2019,
                'image' => $this->createMedia('pieces/2019', $i.'.jpeg')?->getId(),
            ];
        }

        for ($i=1; $i <=46 ; $i++) { 
            $data[] = [
                "play" => $play2021,
                'image' => $this->createMedia('pieces/2021', $i.'.jpg')?->getId(),
            ];
        }

        return $data;
    }

}
