<?php

namespace App\DataFixtures\Financial;

use App\Entity\Site\Play;
use App\Entity\Financial\FinBilan;
use App\Entity\Financial\FinIncome;
use App\Entity\Financial\FinExpense;
use App\Entity\Financial\FinCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use App\DataFixtures\Entities\PlayFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FinExpensesIncomesFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {}

    public function getDependencies()
    {
        return [PlayFixtures::class, FinancialGeneralFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $play = $this->entityManager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId());
        
        // EXPENSES
        $arrayData = $this->getExpenses();
        foreach ($arrayData as $array) {
            $data = new FinExpense();
            $data->setPlay($play);
            $data->setCategory($this->entityManager->getRepository(FinCategory::class)->find($array['category']));
            $data->setDate(new \DateTime($array['date']));
            $data->setPayMode($array['pay_mode']);
            $data->setAmount($array['amount']);
            $data->setDocNumber($array['doc_number']);
            $data->setNotes($array['notes']);
            $data->setFinBilan($this->entityManager->getRepository(FinBilan::class)->find($this->getReference('bilan')->getId()));
            $manager->persist($data);
        }
        $manager->flush();

        // INCOMES
        $arrayData = $this->getIncomes();
        foreach ($arrayData as $array) {
            $data = new FinIncome();
            $data->setPlay($play);
            $data->setCategory($this->entityManager->getRepository(FinCategory::class)->find($array['category']));
            $data->setDate(new \DateTime($array['date']));
            $data->setPayMode($array['pay_mode']);
            $data->setAmount($array['amount']);
            $data->setDocNumber($array['doc_number']);
            $data->setNotes($array['notes']);
            $data->setFinBilan($this->entityManager->getRepository(FinBilan::class)->find($this->getReference('bilan')->getId()));
            $manager->persist($data);
        }
        $manager->flush();
    }

    public function getExpenses()
    {
        return [
            ['category' => '6','date' => '2022-05-18','pay_mode' => 'Chèque','amount' => '425','doc_number' => '0012667410','notes' => 'La Colo'],
            ['category' => '2','date' => '2022-05-27','pay_mode' => 'Chèque','amount' => '118.72','doc_number' => '0012667411','notes' => 'Courses pour la Colo'],
            ['category' => '3','date' => '2022-10-17','pay_mode' => 'CB','amount' => '47.99','doc_number' => NULL,'notes' => 'Masque pour Cap Crochet'],
            ['category' => '2','date' => '2022-11-02','pay_mode' => 'CB','amount' => '94.36','doc_number' => NULL,'notes' => 'Courses pour le Bar'],
        ];
    }

    public function getIncomes()
    {
        return [
            ['category' => '7','date' => '2022-01-31','pay_mode' => 'Chèque','amount' => '155','doc_number' => NULL,'notes' => NULL],
            ['category' => '7','date' => '2022-01-31','pay_mode' => 'Virement','amount' => '70','doc_number' => NULL,'notes' => NULL],
            ['category' => '1','date' => '2022-11-30','pay_mode' => 'Espèces','amount' => '1371.5','doc_number' => NULL,'notes' => 'Chapeau et Bar'],
        ];
    }
}
