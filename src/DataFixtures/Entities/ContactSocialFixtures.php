<?php

namespace App\DataFixtures\Entities;

use App\Entity\Site\ContactSocial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactSocialFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $arrayData = $this->getData();
        foreach ($arrayData as $array) {
            $data = new ContactSocial();
            $data->setName($array['name'] ?? null);
            $data->setAddress($array['address'] ?? null);
            $data->setZipCode($array['zipCode'] ?? null);
            $data->setCity($array['city'] ?? null);
            $data->setMapLink($array['mapLink'] ?? null);
            $data->setFacebook($array['facebook'] ?? null);
            $data->setYoutube($array['youtube'] ?? null);
            $data->setEnabled($array['enabled'] ?? false);
        
            $manager->persist($data);
        }
        $manager->flush();
    }

    public function getData(): array
    {
        return [
            [
                'name' => 'Salle de spectacle Robert-Hossein', 
                'address' => '58 Grand Rue', 
                'zipCode' => '67130', 
                'city' => 'Hersbach - Wisches',
                'mapLink' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2409.7634247611054!2d7.247119215477989!3d48.497677579253775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4794011d9691b6c3%3A0xb0de254bdeffa089!2sLes%20Agit'acteurs!5e1!3m2!1sfr!2sfr!4v1620397084554!5m2!1sfr!2sfr",
                'facebook' => 'https://www.facebook.com/TroupeDesAgitacteurs/',
                'youtube' => 'https://www.youtube.com/channel/UCCoDhFobRo7ffdubj2oIDUQ',
                'enabled' => true,
            ],
        ];
    }
}
