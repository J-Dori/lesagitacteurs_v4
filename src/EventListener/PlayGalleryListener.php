<?php

namespace App\EventListener;

use Doctrine\ORM\Events;
use App\Entity\Site\PlayGallery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: PlayGallery::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: PlayGallery::class)]
class PlayGalleryListener
{

    public function __construct(private EntityManagerInterface $manager)
    {}

    public function prePersist(PlayGallery $gallery, LifecycleEventArgs $event): void
    {
        $play = $event->getObject()->getPlay();
        $lastPosition = $this->getLastPosition($play);
        if (empty($gallery->getPosition())) {
            $gallery->setPosition($lastPosition);
        }
    }

    public function preUpdate(PlayGallery $gallery, LifecycleEventArgs $event): void
    {
        $play = $event->getObject()->getPlay();
        $lastPosition = $this->getLastPosition($play);
        if (empty($gallery->getPosition())) {
            $gallery->setPosition($lastPosition);
        }
    }

    private function getLastPosition($play) {
        $position = $this->manager->getRepository(PlayGallery::class)->getLastPosition($play);
        if (empty($position)) {
            return 1;
        }
        
        return $position[0]['position'] + 1;
    }

}