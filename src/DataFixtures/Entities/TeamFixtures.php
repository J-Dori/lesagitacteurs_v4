<?php

namespace App\DataFixtures\Entities;

use Adeliom\EasyCommonBundle\Enum\ThreeStateStatusEnum;
use App\Entity\Site\Team;
use App\Trait\ObjectStateEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $arrayData = $this->getData();
        foreach ($arrayData as $array) {
            $data = new Team();
            $data->setFirstname($array['firstname'] ?? null);
            $data->setLastname($array['lastname'] ?? null);
            $data->setRole($array['role'] ?? null);
            $data->setRoleOrder($array['role_order'] ?? null);
            $data->setDescription($array['description'] ?? null);
            $data->setState(ObjectStateEnum::ENABLED);
            $data->setImage($array['image'] ?? null);
            if (isset($array['email'])) {
                $data->setEmail($array['email'] ?? null);
            }
            if (isset($array['phone'])) {
                $data->setPhone($array['phone'] ?? null);
            }
            $manager->persist($data);
        }
        $manager->flush();
    }

    public function getData(): array
    {
        return [
            [
                'firstname' => 'Odile', 
                'lastname' => 'PORTMANN', 
                'role' => 'Présidente', 
                'role_order' => 1, 
                'description' => 'Présidente de l\'Association et technicienne du son',
                'image' => null,
            ],
            [
                'firstname' => 'Pierre', 
                'lastname' => 'SCHEIDECKER', 
                'role' => 'Vice-Président', 
                'role_order' => 2, 
                'description' => 'Le fondateur de l\'Association et metteur en scène',
                'image' => null,
            ],            
            [
                'firstname' => 'Laetitia', 
                'lastname' => 'SCHUBNEL', 
                'role' => 'Sécretaire', 
                'role_order' => 3, 
                'description' => 'Sécretaire, décoratrice, accessoiriste et costumière',
                'image' => null,
            ],           
            [
                'firstname' => 'Joël', 
                'lastname' => 'GOMES', 
                'role' => 'Membre Actif', 
                'role_order' => 4, 
                'description' => 'Technicien lumière, décorateur, couturier et webmaster',
                'image' => null,
                'email' => 'joelvg.stb@gmail.com',
                'phone' => '07 52 06 53 06',
            ],           
            [
                'firstname' => 'Estelle', 
                'lastname' => null, 
                'role' => 'Trésorière', 
                'role_order' => 5, 
                'description' => 'Trésorière depuis 2022',
                'image' => null,
            ],
            [
                'firstname' => 'Sylvain', 
                'lastname' => null, 
                'role' => 'Décorateur', 
                'role_order' => 6, 
                'description' => 'Technicien décorateur',
                'image' => null,
            ],
        ];
    }
}
