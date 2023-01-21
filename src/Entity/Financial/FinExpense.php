<?php

namespace App\Entity\Financial;

use App\Entity\Site\Play;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Financial\FinCategory;
use App\Repository\Financial\FinExpenseRepository;
use App\Trait\PayModeEnum;

#[ORM\Entity(repositoryClass: FinExpenseRepository::class)]
class FinExpense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'finExpenses')]
    private ?Play $play = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $payMode;

    #[ORM\Column(nullable: true)]
    private ?float $amount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $docNumber = null;

    #[ORM\Column(length: 5000, nullable: true)]
    private ?string $notes = null;

    #[ORM\ManyToOne(inversedBy: 'finExpenses')]
    private ?FinCategory $category = null;

    #[ORM\ManyToOne(inversedBy: 'finExpenses')]
    private ?FinBilan $finBilan = null;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPayMode(): ?string
    {
        return $this->payMode;
    }

    public function setPayMode(?string $payMode): self
    {
        $this->payMode = $payMode;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDocNumber(): ?string
    {
        return $this->docNumber;
    }

    public function setDocNumber(?string $docNumber): self
    {
        $this->docNumber = $docNumber;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getCategory(): ?FinCategory
    {
        return $this->category;
    }

    public function setCategory(?FinCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getFinBilan(): ?FinBilan
    {
        return $this->finBilan;
    }

    public function setFinBilan(?FinBilan $finBilan): self
    {
        $this->finBilan = $finBilan;

        return $this;
    }

    public function __toString()
    {
        $category = $this->category ? ' : '. $this->category->getName() : '';
        $date = $this->date ? ' du '. date_format($this->date, 'd-m-Y') : '';
        return 'Dépense ' . $category . $date;
    }

}
