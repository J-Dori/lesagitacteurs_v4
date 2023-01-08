<?php

namespace App\DataFixtures\Entities;

use App\Entity\Site\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $arrayData = $this->getData();
        foreach ($arrayData as $array) {
            $data = new Contact();
            $data->setFirstname($array['firstname'] ?? null);
            $data->setLastname($array['lastname'] ?? null);
            $data->setAddress($array['address'] ?? null);
            $data->setZipCode($array['zipCode'] ?? null);
            $data->setCity($array['city'] ?? null);
            $data->setMobilePhone($array['mobilePhone'] ?? null);
            $data->setEmail($array['email'] ?? null);
            $data->setEnabled($array['enabled'] ?? false);
        
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
                'address' => '14 rue des Roseaux', 
                'zipCode' => '67130', 
                'city' => 'Hersbach - Wisches',
                'mobilePhone' => '+33 6 45 69 77 68',
                'email' => 'info@lesagitacteurs.fr',
                'enabled' => true,
            ],
            [
                'firstname' => 'Pierre', 
                'lastname' => 'Scheidecker', 
                'address' => '4 rue du Champ de Commune', 
                'zipCode' => '67130', 
                'city' => 'Barembach',
                'mobilePhone' => '+33 6 32 44 07 53',
                'email' => 'info@lesagitacteurs.fr',
                'enabled' => false,
            ],
        ];
    }
}
