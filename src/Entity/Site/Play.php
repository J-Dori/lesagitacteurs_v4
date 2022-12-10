<?php

namespace App\Entity\Site;

use App\Entity\Site\PlayActorRole;
use App\Trait\PlayStatusEnum;
use App\Trait\ObjectStateEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlayRepository;

#[ORM\Entity(repositoryClass: PlayRepository::class)]
class Play
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 5000, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 4)]
    private ?string $year = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateStart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEnd = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $playStatus = PlayStatusEnum::CLOSED;

    #[ORM\Column(length: 15)]
    private ?string $state = ObjectStateEnum::ENABLED;

    #[ORM\Column(type: 'easy_media_type', nullable: true)]
    private $image = null;

    #[ORM\OneToMany(mappedBy: 'play', targetEntity: PlayActorRole::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection|null $playActorRoles;

    public function __construct()
    {
        $this->playActorRoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(?\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getPlayStatus(): ?string
    {
        return $this->playStatus;
    }

    public function setPlayStatus(?string $playStatus): self
    {
        $this->playStatus = $playStatus;

        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, PlayActorRole>
     */
    public function getPlayActorRoles(): ?Collection
    {
        return $this->playActorRoles;
    }

    public function addPlayActorRole(PlayActorRole $playActorRole): self
    {
        if (!$this->playActorRoles->contains($playActorRole)) {
            $this->playActorRoles->add($playActorRole);
            $playActorRole->setPlay($this);
        }

        return $this;
    }

    public function removePlayActorRole(PlayActorRole $playActorRole): self
    {
        if ($this->playActorRoles->removeElement($playActorRole)) {
            // set the owning side to null (unless already changed)
            if ($playActorRole->getPlay() === $this) {
                $playActorRole->setPlay(null);
            }
        }

        return $this;
    }

    public function getListOfRoles(): ?array
    {
        $result = [];
        foreach ($this->playActorRoles as $role) 
        {
            $result [] = $role->getActor() . " : " . $role->getName();
        }

        return $result;
    }

    public function __toString()
    {
        return $this->name;
    }

}
