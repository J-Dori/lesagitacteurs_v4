<?php

namespace App\DataFixtures\Financial;

use App\Entity\Site\Play;
use App\Entity\Financial\FinBank;
use App\Entity\Financial\FinBilan;
use App\Entity\Financial\FinCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use App\DataFixtures\Entities\PlayFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FinancialGeneralFixtures extends Fixture 
{
    public function __construct(private EntityManagerInterface $manager)
    {}

    public function load(ObjectManager $manager): void
    {
        dump('*************** LOADING : Gestion Financière ***************');

        $data = new FinBilan();
        $data->setYear('2022');
        $data->setActive('ACTIVE');
        $data->setPlay($this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId()));
        $this->addReference('bilan', $data);
        $manager->persist($data);

        $data = new FinBank();
        $data->setBankName('Crédit Mutuelle');
        $data->setYear(2022);
        $data->setBalance(1822.47);
        $data->setActive(true);
        $manager->persist($data);
        $manager->flush();

        $arrayData = $this->getData();
        foreach ($arrayData as $array) {
            $data = new FinCategory();
            $data->setName($array['name'] ?? null);
            $manager->persist($data);
        }
        $manager->flush();
    }

    public function getData(): array
    {
        return [
            ['name' => 'Recette'],
            ['name' => 'Alimentation'],
            ['name' => 'Décoration'],
            ['name' => 'Costume'],
            ['name' => 'Matériel'],
            ['name' => 'Location'],
            ['name' => 'Inscription'],
        ];
    }
}
