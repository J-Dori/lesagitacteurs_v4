<?php

namespace App\EventListener;

use Doctrine\ORM\Events;
use App\Entity\Site\Play;
use App\Trait\PlayStatusEnum;
use App\Repository\PlayRepository;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Play::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Play::class)]
class PlayListener
{

    public function __construct(private PlayRepository $playRepository)
    {}

    public function prePersist(Play $play, LifecycleEventArgs $event): void
    {
        if ($play->getPlayStatus() == PlayStatusEnum::UPFRONT) {
            $this->playRepository->setAllStatusToClose();
        }
    }

    public function preUpdate(Play $play, LifecycleEventArgs $event): void
    {
        if ($play->getPlayStatus() == PlayStatusEnum::UPFRONT) {
            $this->playRepository->setAllStatusToClose();
        }
    }

}