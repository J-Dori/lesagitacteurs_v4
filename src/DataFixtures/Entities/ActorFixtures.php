<?php

namespace App\DataFixtures\Entities;

use App\Entity\Site\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{

    public const CLEMENT = 'Clément';
    public const ELSA = 'Elsa';
    public const CHRISTELLE = 'Christelle';
    public const ALEXIS = 'Alexis';
    public const LUCILE = 'Lucile';
    public const FANNY = 'Fanny';
    public const ELISE_S  = 'Elise_S';
    public const MELANIE = 'Mélanie';
    public const VALENTIN_P = 'Valentin_P';
    public const AMANDINE = 'Amandine';
    public const MAXIME_SCHOTT = 'Maxime_SCHOTT';
    public const PHILIPPE = 'Philippe';
    public const TRISTAN = 'Tristan';
    public const REMI = 'Rémi';
    public const SOFIANE = 'Sofiane';
    public const TIMEO = 'Timéo';
    public const TIMO = 'Timo';
    public const MARIE = 'Marie';
    public const LYNA = 'Lyna';
    public const OWEN = 'Owen';
    public const ENZO = 'Enzo';
    public const LUCIE = 'Lucie';
    public const LILLY_ROSE  = 'Lilly Rose';
    public const MAXIME_SIMON  = 'Maxime_SIMON';
    public const JADE = 'Jade';
    public const CLEMAN_MUNSCH = 'Cléman_MUNSCH';
    public const ELSA_TRAN = 'Elsa_TRAN';
    public const BASTIEN = 'Bastien';
    public const HUGO = 'Hugo';
    public const NOAH = 'Noah';
    public const SEBASTIEN = 'Sebastien';
    public const KELIA = 'Kelia';
    public const NINE = 'Nine';
    public const ZINA = 'Zina';
    public const LILOU = 'Lilou';
    public const LAURIANNE = 'Laurianne';

    public function load(ObjectManager $manager): void
    {
        $arrayActors = $this->getData();
        foreach ($arrayActors as $actor) {
            $data = new Actor();
            $data->setFirstname($actor['firstname'] ?? null);
            $data->setLastname($actor['lastname'] ?? null);
            $manager->persist($data);
            $this->addReference($actor['ref'], $data);
            $manager->flush();
        }
    }

    public function getData(): array
    {
        return [
            ['firstname' => 'Clément', 'ref' => self::CLEMENT],
            ['firstname' => 'Elsa', 'ref' => self::ELSA],
            ['firstname' => 'Christelle', 'ref' => self::CHRISTELLE],
            ['firstname' => 'Alexis', 'ref' => self::ALEXIS],
            ['firstname' => 'Lucile', 'ref' => self::LUCILE],
            ['firstname' => 'Fanny', 'ref' => self::FANNY],
            ['firstname' => 'Elise', 'lastname' => 'S.', 'ref' => self::ELISE_S],
            ['firstname' => 'Mélanie', 'ref' => self::MELANIE],
            ['firstname' => 'Valentin', 'lastname' => 'P.', 'ref' => self::VALENTIN_P],
            ['firstname' => 'Amandine', 'ref' => self::AMANDINE],
            ['firstname' => 'Maxime', 'lastname' => 'SCHOTT', 'ref' => self::MAXIME_SCHOTT],
            ['firstname' => 'Philippe', 'ref' => self::PHILIPPE],
            ['firstname' => 'Tristan', 'ref' => self::TRISTAN],
            ['firstname' => 'Rémi', 'ref' => self::REMI],
            ['firstname' => 'Sofiane', 'ref' => self::SOFIANE],
            ['firstname' => 'Timéo', 'ref' => self::TIMEO],
            ['firstname' => 'Timo', 'ref' => self::TIMO],
            ['firstname' => 'Marie', 'ref' => self::MARIE],
            ['firstname' => 'Lyna', 'ref' => self::LYNA],
            ['firstname' => 'Owen', 'ref' => self::OWEN],
            ['firstname' => 'Enzo', 'ref' => self::ENZO],
            ['firstname' => 'Lucie', 'ref' => self::LUCIE],
            ['firstname' => 'Lilly Rose', 'ref' => self::LILLY_ROSE],
            ['firstname' => 'Maxime', 'lastname' => 'SIMON', 'ref' => self::MAXIME_SIMON],
            ['firstname' => 'Jade', 'ref' => self::JADE],
            ['firstname' => 'Cléman', 'lastname' => 'MUNSCH', 'ref' => self::CLEMAN_MUNSCH],
            ['firstname' => 'Elsa ', 'lastname' => 'TRAN', 'ref' => self::ELSA_TRAN],
            ['firstname' => 'Bastien', 'ref' => self::BASTIEN],
            ['firstname' => 'Hugo', 'ref' => self::HUGO],
            ['firstname' => 'Noah', 'ref' => self::NOAH],
            ['firstname' => 'Sebastien', 'ref' => self::SEBASTIEN],
            ['firstname' => 'Kelia', 'ref' => self::KELIA],
            ['firstname' => 'Nine', 'ref' => self::NINE],
            ['firstname' => 'Zina', 'ref' => self::ZINA],
            ['firstname' => 'Lilou', 'ref' => self::LILOU],
            ['firstname' => 'Laurianne', 'ref' => self::LAURIANNE],
        ];
    }
}
