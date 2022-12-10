<?php

namespace App\DataFixtures\Entities;

use App\Entity\Site\Play;
use App\Entity\Site\Actor;
use App\Trait\ObjectStateEnum;
use App\Entity\Site\PlayActorRole;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use App\DataFixtures\Entities\PlayFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Entities\ActorFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PlayActorRoleFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(private EntityManagerInterface $manager)
    {}

    public function getDependencies()
    {
        return [ActorFixtures::class, PlayFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $arrayData = $this->getData();
        foreach ($arrayData as $array) {
            $data = new PlayActorRole();
            $data->setPlay($array['play'] ?? null);
            $data->setActor($array['actor'] ?? null);
            $data->setName($array['name'] ?? null);
            $data->setState(ObjectStateEnum::ENABLED);
            $manager->persist($data);
        }
        $manager->flush();
    }

     
    public function getData(): array
    {
        return [
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::METRO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ALEXIS)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::METRO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::CHRISTELLE)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::METRO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::CLEMENT)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::METRO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ELISE_S)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::METRO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ELSA)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::METRO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::FANNY)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::METRO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LUCILE)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::METRO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::MELANIE)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::METRO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::VALENTIN_P)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::AMANDINE)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::CHRISTELLE)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::CLEMENT)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ELSA)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::FANNY)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::MAXIME_SCHOTT)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::MELANIE)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::PHILIPPE)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::REMI)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::TRISTAN)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PROCES)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::VALENTIN_P)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PHILEAS_FOGG)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ALEXIS)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PHILEAS_FOGG)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::AMANDINE)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PHILEAS_FOGG)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::CLEMENT)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PHILEAS_FOGG)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::MAXIME_SCHOTT)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PHILEAS_FOGG)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::MELANIE)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PHILEAS_FOGG)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::REMI)->getId()),
            ],
            [
                "name" => "Policier",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::TOUT_LE_MONDE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::CLEMAN_MUNSCH)->getId()),
            ],
            [
                "name" => "Benjamine",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::TOUT_LE_MONDE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ELSA_TRAN)->getId()),
            ],
            [
                "name" => "Le Gangster",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::TOUT_LE_MONDE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::HUGO)->getId()),
            ],
            [
                "name" => "Felix",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::TOUT_LE_MONDE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::NOAH)->getId()),
            ],
            [
                "name" => "Monsieur Ripaux",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::TOUT_LE_MONDE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::SEBASTIEN)->getId()),
            ],
            [
                "name" => "Geppeto",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PINOCCHIOS)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::CLEMAN_MUNSCH)->getId()),
            ],
            [
                "name" => "Le Grillion",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PINOCCHIOS)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ELSA_TRAN)->getId()),
            ],
            [
                "name" => "Le Renard",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PINOCCHIOS)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::HUGO)->getId()),
            ],
            [
                "name" => "Le Maitre",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PINOCCHIOS)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::SEBASTIEN)->getId()),
            ],
            [
                "name" => "Charles Perrault",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CHARLES_PERRAULT)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::CLEMAN_MUNSCH)->getId()),
            ],
            [
                "name" => "Grimm",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CHARLES_PERRAULT)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ELSA_TRAN)->getId()),
            ],
            [
                "name" => "Poucet",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CHARLES_PERRAULT)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::HUGO)->getId()),
            ],
            [
                "name" => "Le Chat Botté",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CHARLES_PERRAULT)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::NOAH)->getId()),
            ],
            [
                "name" => "Le petit Chaperon Rouge",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CHARLES_PERRAULT)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::SEBASTIEN)->getId()),
            ],
            [
                "name" => "Cecil",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CANTERVILLE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::CLEMAN_MUNSCH)->getId()),
            ],
            [
                "name" => "Virginia",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CANTERVILLE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ELSA_TRAN)->getId()),
            ],
            [
                "name" => "Fantome",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CANTERVILLE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ENZO)->getId()),
            ],
            [
                "name" => "Canterville",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CANTERVILLE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::HUGO)->getId()),
            ],
            [
                "name" => "Fantome",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CANTERVILLE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LILLY_ROSE)->getId()),
            ],
            [
                "name" => "Fantome",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CANTERVILLE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LYNA)->getId()),
            ],
            [
                "name" => "Washington",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CANTERVILLE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::NOAH)->getId()),
            ],
            [
                "name" => "Le Jardinier",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CANTERVILLE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::OWEN)->getId()),
            ],
            [
                "name" => "Monsieur Otis",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CANTERVILLE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::SEBASTIEN)->getId()),
            ],
            [
                "name" => "Telemaque",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::BASTIEN)->getId()),
            ],
            [
                "name" => "Ulysse",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::CLEMAN_MUNSCH)->getId()),
            ],
            [
                "name" => "Athena",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ELSA_TRAN)->getId()),
            ],
            [
                "name" => "Fantome",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ENZO)->getId()),
            ],
            [
                "name" => "Perimede",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::HUGO)->getId()),
            ],
            [
                "name" => "fantome",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::KELIA)->getId()),
            ],
            [
                "name" => "Eucharis",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LAURIANNE)->getId()),
            ],
            [
                "name" => "sirene",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LILLY_ROSE)->getId()),
            ],
            [
                "name" => "Anticlée",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LYNA)->getId()),
            ],
            [
                "name" => "Eurilochos",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::NOAH)->getId()),
            ],
            [
                "name" => "Zeus",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::OWEN)->getId()),
            ],
            [
                "name" => "Poseidon",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ULYSSE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::SEBASTIEN)->getId()),
            ],
            [
                "name" => "Le Lapin Blanc",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::BASTIEN)->getId()),
            ],
            [
                "name" => "ET l'extraterrestre",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ENZO)->getId()),
            ],
            [
                "name" => "La Chenille",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::HUGO)->getId()),
            ],
            [
                "name" => "le Canard",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::KELIA)->getId()),
            ],
            [
                "name" => "Le valet",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LILLY_ROSE)->getId()),
            ],
            [
                "name" => "La Reine de Coeur",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LILOU)->getId()),
            ],
            [
                "name" => "Alice",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LYNA)->getId()),
            ],
            [
                "name" => "Le Chaperon Rouge",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::NINE)->getId()),
            ],
            [
                "name" => "Le vieux monsieur ",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::NOAH)->getId()),
            ],
            [
                "name" => "Le Chapelier",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::OWEN)->getId()),
            ],
            [
                "name" => "Barbie",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::ALICE)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ZINA)->getId()),
            ],
            [
                "name" => "L'ane",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CABARETTO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ENZO)->getId()),
            ],
            [
                "name" => "La Diva",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CABARETTO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::JADE)->getId()),
            ],
            [
                "name" => "Flamenca",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CABARETTO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LILLY_ROSE)->getId()),
            ],
            [
                "name" => "Musicien",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CABARETTO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LUCIE)->getId()),
            ],
            [
                "name" => "Pochette",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CABARETTO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LYNA)->getId()),
            ],
            [
                "name" => "Toploline",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CABARETTO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::MARIE)->getId()),
            ],
            [
                "name" => "Baraquetto",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CABARETTO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::OWEN)->getId()),
            ],
            [
                "name" => "Pipo",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CABARETTO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::SOFIANE)->getId()),
            ],
            [
                "name" => "",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::CABARETTO)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::TIMO)->getId()),
            ],
            [
                "name" => "Mouche",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::ENZO)->getId()),
            ],
            [
                "name" => "Enfant Perdu, Pirate",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LILLY_ROSE)->getId()),
            ],
            [
                "name" => "Pirate",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LUCIE)->getId()),
            ],
            [
                "name" => "Clochette",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::LYNA)->getId()),
            ],
            [
                "name" => "Wendy",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::MARIE)->getId()),
            ],
            [
                "name" => "Frère de Wendy",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::MAXIME_SIMON)->getId()),
            ],
            [
                "name" => "Capitaine Crochet",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::OWEN)->getId()),
            ],
            [
                "name" => "Peter Pan",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::SOFIANE)->getId()),
            ],
            [
                "name" => "Enfant Perdu",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::TIMEO)->getId()),
            ],
            [
                "name" => "Peter Pan",
                "play" => $this->manager->getRepository(Play::class)->find($this->getReference(PlayFixtures::PETER_PAN)->getId()),
                "actor" => $this->manager->getRepository(Actor::class)->find($this->getReference(ActorFixtures::TIMO)->getId()),
            ],
        ];
    }

}
