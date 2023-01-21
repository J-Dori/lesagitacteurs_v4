<?php

namespace App\Entity\Financial;

use App\Entity\Site\Play;
use App\Repository\Financial\FinBilanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FinBilanRepository::class)]
class FinBilan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $year = null;

    #[ORM\ManyToOne(inversedBy: 'finBilans')]
    private ?Play $play = null;

    #[ORM\Column]
    private ?bool $active = false;

    #[ORM\OneToMany(mappedBy: 'finBilan', targetEntity: FinExpense::class)]
    private Collection $finExpenses;

    #[ORM\OneToMany(mappedBy: 'finBilan', targetEntity: FinIncome::class)]
    private Collection $finIncomes;

    public function __construct()
    {
        $this->finExpenses = new ArrayCollection();
        $this->finIncomes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): self
    {
        $this->year = $year;

        return $this;
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

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

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
            $finExpense->setFinBilan($this);
        }

        return $this;
    }

    public function removeFinExpense(FinExpense $finExpense): self
    {
        if ($this->finExpenses->removeElement($finExpense)) {
            // set the owning side to null (unless already changed)
            if ($finExpense->getFinBilan() === $this) {
                $finExpense->setFinBilan(null);
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
            $finIncome->setFinBilan($this);
        }

        return $this;
    }

    public function removeFinIncome(FinIncome $finIncome): self
    {
        if ($this->finIncomes->removeElement($finIncome)) {
            // set the owning side to null (unless already changed)
            if ($finIncome->getFinBilan() === $this) {
                $finIncome->setFinBilan(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->year . (!empty($this->play) ? ' : ' . $this->play->getName() : '');
    }

}
