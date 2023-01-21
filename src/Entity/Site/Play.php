<?php

namespace App\Entity\Site;

use App\Entity\Financial\FinBilan;
use App\Trait\PlayStatusEnum;
use App\Trait\ObjectStateEnum;
use Doctrine\DBAL\Types\Types;
use App\Entity\EasyMedia\Media;
use App\Entity\Site\PlayGallery;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Site\PlayActorRole;
use App\Repository\PlayRepository;
use App\Entity\Financial\FinIncome;
use App\Entity\Financial\FinExpense;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PlayRepository::class)]
#[ORM\HasLifecycleCallbacks]
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
    private Media|int|null $image = null;

    #[ORM\OneToMany(mappedBy: 'play', targetEntity: PlayActorRole::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection|null $playActorRoles;

    #[ORM\OneToMany(mappedBy: 'play', targetEntity: PlayGallery::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $playGalleries;

    #[ORM\OneToMany(mappedBy: 'play', targetEntity: FinIncome::class, orphanRemoval: false)]
    private Collection $finIncomes;

    #[ORM\OneToMany(mappedBy: 'play', targetEntity: FinExpense::class, orphanRemoval: false)]
    private Collection $finExpenses;

    #[ORM\OneToMany(mappedBy: 'play', targetEntity: FinBilan::class)]
    private Collection $finBilans;


    public function __construct()
    {
        $this->playActorRoles = new ArrayCollection();
        $this->playGalleries = new ArrayCollection();
        $this->finIncomes = new ArrayCollection();
        $this->finExpenses = new ArrayCollection();
        $this->finBilans = new ArrayCollection();
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

    public function getImage(): int|Media|null
    {
        return $this->image;
    }

    public function setImage(int|Media|null $image)
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

    public function getYearAndName()
    {
        return $this->getYear() .' - '. $this->name;
    }

    /**
     * @return Collection<int, PlayGallery>
     */
    public function getPlayGalleries(): Collection
    {
        return $this->playGalleries;
    }

    public function addPlayGallery(PlayGallery $playGallery): self
    {
        if (!$this->playGalleries->contains($playGallery)) {
            $this->playGalleries->add($playGallery);
            $playGallery->setPlay($this);
        }

        return $this;
    }

    public function removePlayGallery(PlayGallery $playGallery): self
    {
        if ($this->playGalleries->removeElement($playGallery)) {
            // set the owning side to null (unless already changed)
            if ($playGallery->getPlay() === $this) {
                $playGallery->setPlay(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FinIncome>
     */
    public function getFinIncomes(): Collection
    {
        return $this->finIncomes;
    }

    public function addFinIncome(FinIncome $finIncome): self
    {
        if (!$this->finIncomes->contains($finIncome)) {
            $this->finIncomes->add($finIncome);
            $finIncome->setPlay($this);
        }

        return $this;
    }

    public function removeFinIncome(FinIncome $finIncome): self
    {
        if ($this->finIncomes->removeElement($finIncome)) {
            // set the owning side to null (unless already changed)
            if ($finIncome->getPlay() === $this) {
                $finIncome->setPlay(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FinExpense>
     */
    public function getFinExpenses(): Collection
    {
        return $this->finExpenses;
    }

    public function addFinExpense(FinExpense $finExpense): self
    {
        if (!$this->finExpenses->contains($finExpense)) {
            $this->finExpenses->add($finExpense);
            $finExpense->setPlay($this);
        }

        return $this;
    }

    public function removeFinExpense(FinExpense $finExpense): self
    {
        if ($this->finExpenses->removeElement($finExpense)) {
            // set the owning side to null (unless already changed)
            if ($finExpense->getPlay() === $this) {
                $finExpense->setPlay(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FinBilan>
     */
    public function getFinBilans(): Collection
    {
        return $this->finBilans;
    }

    public function addFinBilan(FinBilan $finBilan): self
    {
        if (!$this->finBilans->contains($finBilan)) {
            $this->finBilans->add($finBilan);
            $finBilan->setPlay($this);
        }

        return $this;
    }

    public function removeFinBilan(FinBilan $finBilan): self
    {
        if ($this->finBilans->removeElement($finBilan)) {
            // set the owning side to null (unless already changed)
            if ($finBilan->getPlay() === $this) {
                $finBilan->setPlay(null);
            }
        }

        return $this;
    }

}
