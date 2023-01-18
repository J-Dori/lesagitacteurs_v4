<?php

namespace App\DataFixtures\Financial;

use App\Entity\Financial\FinBank;
use App\Entity\Financial\FinCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FinCategoryFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
    {
        dump('*************** LOADING : Gestion Financière ***************');

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
            ['name' => 'Revenu'],
            ['name' => 'Alimentation'],
            ['name' => 'Décoration'],
            ['name' => 'Costume'],
            ['name' => 'Matériel'],
            ['name' => 'Location'],
            ['name' => 'Inscription'],
        ];
    }
}
