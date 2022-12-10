<?php

namespace App\Entity\Site;

use App\Entity\Site\Play;
use App\Entity\Site\Actor;
use App\Trait\ObjectStateEnum;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlayActorRoleRepository;

#[ORM\Entity(repositoryClass: PlayActorRoleRepository::class)]
class PlayActorRole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playActorRoles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Play $play = null;

    #[ORM\ManyToOne(inversedBy: 'playActorRoles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Actor $actor = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 15)]
    private ?string $state = ObjectStateEnum::ENABLED;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlay(): ?Play
    {
        return $this->play;
    }

    public function setPlay(?Play $play): self
    {
        $this->play = $play;

        return $this;
    }

    public function getActor(): ?Actor
    {
        return $this->actor;
    }

    public function setActor(?Actor $actor): self
    {
        $this->actor = $actor;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getPlayAndYear()
    {
        return $this->play->getYear() .' - '. $this->play;
    }

    public function __toString()
    {
        return $this->actor->getFullname() . ' : ' . $this->name;
    }

}
