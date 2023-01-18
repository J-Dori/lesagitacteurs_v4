<?php

namespace App\Entity\Financial;


use App\Entity\Financial\FinExpense;
use App\Entity\Financial\FinIncome;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\Financial\FinCategoryRepository;

#[ORM\Entity(repositoryClass: FinCategoryRepository::class)]
class FinCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: FinIncome::class)]
    private Collection $finIncomes;
    
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: FinExpense::class)]
    private Collection $finExpenses;

    public function __construct()
    {
        $this->finIncomes = new ArrayCollection();
        $this->finExpenses = new ArrayCollection();
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
            $finIncome->setCategory($this);
        }

        return $this;
    }

    public function removeFinIncome(FinIncome $finIncome): self
    {
        if ($this->finIncomes->removeElement($finIncome)) {
            // set the owning side to null (unless already changed)
            if ($finIncome->getCategory() === $this) {
                $finIncome->setCategory(null);
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
            $finExpense->setCategory($this);
        }

        return $this;
    }

    public function removeFinExpense(FinExpense $finExpense): self
    {
        if ($this->finExpenses->removeElement($finExpense)) {
            // set the owning side to null (unless already changed)
            if ($finExpense->getCategory() === $this) {
                $finExpense->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
