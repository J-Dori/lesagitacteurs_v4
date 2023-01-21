<?php

namespace App\EventListener;

use App\Entity\Financial\FinBank;
use Doctrine\ORM\Events;
use App\Entity\Financial\FinBilan;
use App\Entity\Financial\FinIncome;
use App\Entity\Financial\FinExpense;
use App\Repository\Financial\FinBankRepository;
use App\Repository\Financial\FinBilanRepository;
use App\Repository\Financial\FinIncomeRepository;
use App\Repository\Financial\FinExpenseRepository;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::prePersist, method: 'prePersistIncome', entity: FinIncome::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdateIncome', entity: FinIncome::class)]

#[AsEntityListener(event: Events::prePersist, method: 'prePersistExpense', entity: FinExpense::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdateExpense', entity: FinExpense::class)]

#[AsEntityListener(event: Events::prePersist, method: 'prePersistBBank', entity: FinBBank::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdateBBank', entity: FinBBank::class)]

#[AsEntityListener(event: Events::prePersist, method: 'prePersistBilan', entity: FinBilan::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdateBilan', entity: FinBilan::class)]
class FinancialListener
{
    public function __construct(
        private FinBankRepository $bankRepo,
        private FinBilanRepository $bilanRepo,
        private FinIncomeRepository $incomeRepo,
        private FinExpenseRepository $expenseRepo,
    )
    {}

    // INCOMES
    private function addAmout(?float $amount)
    {
        $currentBalance = $this->bankRepo->getCurrentBalance();
        $this->bankRepo->updateBalance($currentBalance + (!empty($amount) ? $amount : 0));
    }

    public function prePersistIncome(FinIncome $income,LifecycleEventArgs $event): void
    {
        $this->addAmout($event->getObject()->getAmount());
    }

    public function preUpdateIncome(FinIncome $income,LifecycleEventArgs $event): void
    {
        $this->addAmout($event->getObject()->getAmount());
    }

    // EXPENSES
    private function subtractAmout(?float $amount)
    {
        $currentBalance = $this->bankRepo->getCurrentBalance();
        $this->bankRepo->updateBalance($currentBalance - (!empty($amount) ? $amount : 0));
    }

    public function prePersistExpense(FinExpense $expense, LifecycleEventArgs $event): void
    {
        $this->subtractAmout($event->getObject()->getAmount());
    }

    public function preUpdateExpense(FinExpense $expense, LifecycleEventArgs $event): void
    {
        $this->subtractAmout($event->getObject()->getAmount());
    }

    // BANK
    public function prePersistBank(FinBank $bank, LifecycleEventArgs $event): void
    {
        if ($event->getObject()->isActive())
            $this->bankRepo->setAllActiveFalse();
    }

    public function preUpdateBank(FinBank $bank, LifecycleEventArgs $event): void
    {
        if ($event->getObject()->isActive())
            $this->bankRepo->setAllActiveFalse();
    }

    // BILAN
    public function prePersistBilan(FinBilan $bilan, LifecycleEventArgs $event): void
    {
        if ($event->getObject()->isActive())
            $this->bilanRepo->setAllActiveFalse();
    }

    public function preUpdateBilan(FinBilan $bilan, LifecycleEventArgs $event): void
    {
        if ($event->getObject()->isActive())
            $this->bilanRepo->setAllActiveFalse();
    }

}
