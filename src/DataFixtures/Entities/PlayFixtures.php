<?php

declare(strict_types=1);

namespace App\DataFixtures\Entities;

use Adeliom\EasyMediaBundle\Service\EasyMediaManager;
use App\DataFixtures\Helpers\MediaHelpers;
use DateTime;
use App\Entity\Site\Play;
use App\Trait\ObjectStateEnum;
use App\Trait\PlayStatusEnum;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class PlayFixtures extends Fixture implements FixtureGroupInterface
{

    use MediaHelpers;

    public const METRO = 'metro-2008';
    public const PROCES = 'proces-2010';
    public const RICKY = 'ricky-2011';
    public const TELE_VIVANTE = 'tele-vivante-2013';
    public const PHILEAS_FOGG = 'phileas-fogg-2013';
    public const TOUT_LE_MONDE = 'tout-le-monde-2014';
    public const PINOCCHIOS = 'pinocchios-2015';
    public const CHARLES_PERRAULT = 'charles-perrault-2016';
    public const CANTERVILLE = 'canterville-2017';
    public const ULYSSE = 'ulysse-2018';
    public const ALICE = 'alice-2019';
    public const CABARETTO = 'cabaretto-2021';
    public const PETER_PAN = 'peter-pan-2022';

    
    public function __construct(private KernelInterface $kernel, private EasyMediaManager $easyMediaManager)
    { }

    public function load(ObjectManager $manager): void
    {
        $arrayData = $this->getData();
        foreach ($arrayData as $array) {
            $data = new Play();
            $data->setName($array['name'] ?? null);
            $data->setDescription($array['description'] ?? null);
            $data->setDateStart($array['date_start'] ? new DateTime($array['date_start']) : null);
            $data->setDateEnd($array['date_end'] ? new DateTime($array['date_end']) : null);
            $data->setYear($array['year'] ?? null);
            $data->setImage($array['image'] ?? null);
            $data->setPlayStatus($array['playStatus'] ?? null);
            $data->setState(ObjectStateEnum::ENABLED);
            $manager->persist($data);
            $this->addReference($array['ref'], $data);
            $manager->flush();
        }
    }

    public function getData(): array
    {
        return [
            [
                'name' => 'Le métro mé pas tro',
                'description' => "<div><strong>Le métro!</strong> Quel endroit extraordinaire !<br>La foule passe, écoutez le gens... cent caractères différents, cent langages qui disent pourtant la même chose:<br>«<em>Je prends le métro pour aller travailler. Dans la rame, les voyageurs sont assis ou debout. Des guitaristes chantent.</em>»<br>À partir de ces trois phrases, <strong><em>Yak Rivais</em></strong> a imaginé des monologues, dialogues, sketches et saynètes avec toutes sortes de personnages caricaturés sur tous les tons.</div><div>Faites connaissance avec l'<strong>Aventurier</strong>, l'<strong>Empoisonneur</strong>, le <strong>Professeur</strong>, le <strong>Snob</strong>, le <strong>Goujat </strong>et tous les autres...</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2008',
                'image' => $this->createMedia('pieces/2008', '2008.png')?->getId(),
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::METRO,
            ],
            [
                'name' => 'Le procès du Loup',
                'description' => "<div><strong>Le procès du Loup</strong>... quelle idée!!!</div><div>Il y a pourtant là juge, avocats, victimes, témoins... un procès digne de ce nom. Un procès où les humains doivent juger le plus célèbre des personnages de conte...</div><div>Coupable? Non coupable?.... Le verdict sera peut-être bien différent de celui qu'on attendait!</div><div>Cette variation sur l'histoire du «Petit Chaperon Rouge» est une pièce drôle et originale. C'est aussi une entrée idéale dans le monde du théâtre, favorisée par la diversité des personnages, de leur caractère, de leur comportement, par la cohabitation du réel et du merveilleux...</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2010',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::PROCES,
            ],
            [
                'name' => 'Ricky Pompon',
                'description' => "<div>Petit garçon de 7 ans et demi, <strong>Ricky Pompon</strong>, est élevé par son frère <strong>Nestor</strong>.</div><div>Nestor est «l’homme le plus fort du monde».</div><div>Il y a aussi <strong>Robert Musset</strong> le dompteur et sa femme <strong>Simone</strong>; <strong>Bongo </strong>le fakir et sa planche à clous; le magicien, et comte, <strong>Zubrowska </strong>et son assistant <strong>Smirnoff</strong>; la grande, la seule, la vraie <strong>Calamity Jane</strong> dont Nestor est amoureux.</div><div>Une nuit, après la parade des forains à laquelle Ricky assiste ébloui, il décide de s’enfuir pour trouver le moyen de grandir plus vite…</div><div>Au fur et à mesure de ses rencontres nocturnes avec les habitants des roulottes du camp, il va effectivement grandir mais pas au sens ou il l’entendait… Ceux qu’il avait coutume de rencontrer le jour, montrent la nuit de nouveaux visages, parfois beaucoup plus effrayants ou étonnants.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2011',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::RICKY,
            ],
            [
                'name' => 'La soirée télé vivante',
                'description' => "<div>Prenez deux vieilles dames, une bonne, un inspecteur désabusé, un médium charlatan et... secouez bien pour obtenir un film policier plein d'humour «<strong><em>Le chat assassiné</em></strong>».</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2013',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::TELE_VIVANTE,
            ],
            [
                'name' => 'Les aventures de Philéas Fogg',
                'description' => "<div>En 1872, le très Britannique <strong>Phileas Fogg</strong>, et son valet <strong>Passe-partout</strong> lancent un pari insensé :</div><div><strong>Faire le Tour du Monde en 80 jours</strong></div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2013',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::PHILEAS_FOGG,
            ],
            [
                'name' => 'Comme tout le monde',
                'description' => "<div>La famille Ripaux a décidé que, cette année, ils passeront leurs vacances <strong>comme tout le monde</strong>.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2014',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::TOUT_LE_MONDE,
            ],
            [
                'name' => 'Les aventures de Pinocchios!',
                'description' => "<div>Au début un rêve : fabriquer une marionnette merveilleuse qui saurait danser, faire de l’escrime et exécuter des sauts périlleux.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2015',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::PINOCCHIOS,
            ],
            [
                'name' => 'Qui a tué Charles Perrault?',
                'description' => "<div><strong>Charles Perrault a été tué ! </strong>Qui a pu commettre ce meurtre ?</div><div>Le détective privé <strong>Paul X</strong> est chargé de l'enquête.</div><div>Il convoque tous les personnages des contes de Perrault afin de savoir qui peut être le ou la coupable. Il découvrira, suite à ses interrogatoires, que chacun d'entre eux avait de bonnes raisons de vouloir assassiner <strong>Charles Perrault</strong>.</div><div>C’est ce que vous apprendrez au bout d’une heure de ce spectacle plein de suspense et d’humour.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2016',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::CHARLES_PERRAULT,
            ],
            [
                'name' => 'Le Fantôme de Canterville',
                'description' => "<div>Au dix-neuvième siècle, une riche famille américaine achète pour un prix dérisoire, trop beau pour être vrai, un manoir anglais qui s'avère être hanté par le fantôme de l'ignoble <strong>Sir Simon de Canterville</strong>, un présumé assassin.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2017',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::CANTERVILLE,
            ],
            [
                'name' => 'L\'Odyssée d\'Ulysse',
                'description' => "<div>D'après le mythe d'<strong>Homère</strong>, revisité et dépoussiéré !</div><div><strong>L'Odyssée d'Ulysse</strong> est une pièce comique au rythme endiablé qui raconte l'histoire d'<strong>Ulysse</strong> et de ses compagnons sur le chemin du retour à Ithaque, jusqu'au combat pour reconquérir le trône et sauver <strong>Pénélope</strong>.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2018',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::ULYSSE,
            ],
            [
                'name' => 'Alice et autres merveilles',
                'description' => "<div>Une plongée merveilleuse!...<br>&nbsp;<br>On retrouve dans cette adaptation les personnages piliers du conte de <strong><em>Lewis Carroll</em></strong>: la <strong>Reine de Cœur</strong>, le <strong>Chapelier Fou</strong>, le <strong>Lapin </strong>pressé, le <strong>Chat du Cheshire</strong>, la <strong>Chenille</strong>…<br><br></div><div>Mais pas que ! Des figures plus inattendues telles que le <strong>Petit Chaperon Rouge</strong>, <strong>Pinocchio</strong>, le <strong>Grand Méchant Loup</strong> ou encore la poupée <strong>Barbie </strong>sont convoquées dans ce voyage vers les contrées merveilleuses de l’imagination. Ils s’immiscent tour à tour dans l’histoire d’Alice et dans un univers où tout est possible...</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2019',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::ALICE,
            ],
            [
                'name' => 'Cabaretto',
                'description' => "<div>Au Cabaretto, c’est l’heure de la répétition du grand numéro de ce soir, mais les musiciens roupillent, <strong>Flamenca</strong>, «la dompteuse de poussière» n’a d’autre volonté que de pourchasser <strong>Topoline</strong>, la souris géante et <strong>Pipo </strong>et <strong>Pochette </strong>sont en retard, plus désireux de se déclarer leur amour que de travailler.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2021',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::CABARETTO,
            ],
            [
                'name' => 'Peter Pan',
                'description' => "<div><strong>Peter Pan</strong> est un petit garçon qui refuse de grandir.<br><br></div><div>Un jour, il rend visite à <strong>Wendy</strong> dans le cœur de Londres et la convainc de venir, avec ses frères, dans le pays imaginaire.<br><br></div><div>C'est là-bas que vivent les enfants perdus, la fée <strong>Clochette</strong> et le redoutable <strong>Capitaine Crochet</strong> l'ennemi, juré de <strong>Peter</strong> !</div>",
                'date_start' => '2022-11-04',
                'date_end' => '2022-11-20',
                'year' => '2022',
                'playStatus' => PlayStatusEnum::UPFRONT,
                'ref' => self::PETER_PAN,
            ],
        ];
    }

    public static function getGroups(): array
    {
        return ['entity'];
    }

}
