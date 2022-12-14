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
                'name' => 'Le m??tro m?? pas tro',
                'description' => "<div><strong>Le m??tro!</strong> Quel endroit extraordinaire !<br>La foule passe, ??coutez le gens... cent caract??res diff??rents, cent langages qui disent pourtant la m??me chose:<br>??<em>Je prends le m??tro pour aller travailler. Dans la rame, les voyageurs sont assis ou debout. Des guitaristes chantent.</em>??<br>?? partir de ces trois phrases, <strong><em>Yak Rivais</em></strong> a imagin?? des monologues, dialogues, sketches et sayn??tes avec toutes sortes de personnages caricatur??s sur tous les tons.</div><div>Faites connaissance avec l'<strong>Aventurier</strong>, l'<strong>Empoisonneur</strong>, le <strong>Professeur</strong>, le <strong>Snob</strong>, le <strong>Goujat </strong>et tous les autres...</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2008',
                'image' => $this->createMedia('pieces/2008', '2008.png')?->getId(),
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::METRO,
            ],
            [
                'name' => 'Le proc??s du Loup',
                'description' => "<div><strong>Le proc??s du Loup</strong>... quelle id??e!!!</div><div>Il y a pourtant l?? juge, avocats, victimes, t??moins... un proc??s digne de ce nom. Un proc??s o?? les humains doivent juger le plus c??l??bre des personnages de conte...</div><div>Coupable? Non coupable?.... Le verdict sera peut-??tre bien diff??rent de celui qu'on attendait!</div><div>Cette variation sur l'histoire du ??Petit Chaperon Rouge?? est une pi??ce dr??le et originale. C'est aussi une entr??e id??ale dans le monde du th????tre, favoris??e par la diversit?? des personnages, de leur caract??re, de leur comportement, par la cohabitation du r??el et du merveilleux...</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2010',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::PROCES,
            ],
            [
                'name' => 'Ricky Pompon',
                'description' => "<div>Petit gar??on de 7 ans et demi, <strong>Ricky Pompon</strong>, est ??lev?? par son fr??re <strong>Nestor</strong>.</div><div>Nestor est ??l???homme le plus fort du monde??.</div><div>Il y a aussi <strong>Robert Musset</strong> le dompteur et sa femme <strong>Simone</strong>; <strong>Bongo </strong>le fakir et sa planche ?? clous; le magicien, et comte, <strong>Zubrowska </strong>et son assistant <strong>Smirnoff</strong>; la grande, la seule, la vraie <strong>Calamity Jane</strong> dont Nestor est amoureux.</div><div>Une nuit, apr??s la parade des forains ?? laquelle Ricky assiste ??bloui, il d??cide de s???enfuir pour trouver le moyen de grandir plus vite???</div><div>Au fur et ?? mesure de ses rencontres nocturnes avec les habitants des roulottes du camp, il va effectivement grandir mais pas au sens ou il l???entendait??? Ceux qu???il avait coutume de rencontrer le jour, montrent la nuit de nouveaux visages, parfois beaucoup plus effrayants ou ??tonnants.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2011',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::RICKY,
            ],
            [
                'name' => 'La soir??e t??l?? vivante',
                'description' => "<div>Prenez deux vieilles dames, une bonne, un inspecteur d??sabus??, un m??dium charlatan et... secouez bien pour obtenir un film policier plein d'humour ??<strong><em>Le chat assassin??</em></strong>??.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2013',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::TELE_VIVANTE,
            ],
            [
                'name' => 'Les aventures de Phil??as Fogg',
                'description' => "<div>En 1872, le tr??s Britannique <strong>Phileas Fogg</strong>, et son valet <strong>Passe-partout</strong> lancent un pari insens?? :</div><div><strong>Faire le Tour du Monde en 80 jours</strong></div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2013',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::PHILEAS_FOGG,
            ],
            [
                'name' => 'Comme tout le monde',
                'description' => "<div>La famille Ripaux a d??cid?? que, cette ann??e, ils passeront leurs vacances <strong>comme tout le monde</strong>.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2014',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::TOUT_LE_MONDE,
            ],
            [
                'name' => 'Les aventures de Pinocchios!',
                'description' => "<div>Au d??but un r??ve : fabriquer une marionnette merveilleuse qui saurait danser, faire de l???escrime et ex??cuter des sauts p??rilleux.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2015',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::PINOCCHIOS,
            ],
            [
                'name' => 'Qui a tu?? Charles Perrault?',
                'description' => "<div><strong>Charles Perrault a ??t?? tu?? ! </strong>Qui a pu commettre ce meurtre ?</div><div>Le d??tective priv?? <strong>Paul X</strong> est charg?? de l'enqu??te.</div><div>Il convoque tous les personnages des contes de Perrault afin de savoir qui peut ??tre le ou la coupable. Il d??couvrira, suite ?? ses interrogatoires, que chacun d'entre eux avait de bonnes raisons de vouloir assassiner <strong>Charles Perrault</strong>.</div><div>C???est ce que vous apprendrez au bout d???une heure de ce spectacle plein de suspense et d???humour.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2016',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::CHARLES_PERRAULT,
            ],
            [
                'name' => 'Le Fant??me de Canterville',
                'description' => "<div>Au dix-neuvi??me si??cle, une riche famille am??ricaine ach??te pour un prix d??risoire, trop beau pour ??tre vrai, un manoir anglais qui s'av??re ??tre hant?? par le fant??me de l'ignoble <strong>Sir Simon de Canterville</strong>, un pr??sum?? assassin.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2017',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::CANTERVILLE,
            ],
            [
                'name' => 'L\'Odyss??e d\'Ulysse',
                'description' => "<div>D'apr??s le mythe d'<strong>Hom??re</strong>, revisit?? et d??poussi??r?? !</div><div><strong>L'Odyss??e d'Ulysse</strong> est une pi??ce comique au rythme endiabl?? qui raconte l'histoire d'<strong>Ulysse</strong> et de ses compagnons sur le chemin du retour ?? Ithaque, jusqu'au combat pour reconqu??rir le tr??ne et sauver <strong>P??n??lope</strong>.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2018',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::ULYSSE,
            ],
            [
                'name' => 'Alice et autres merveilles',
                'description' => "<div>Une plong??e merveilleuse!...<br>&nbsp;<br>On retrouve dans cette adaptation les personnages piliers du conte de <strong><em>Lewis Carroll</em></strong>: la <strong>Reine de C??ur</strong>, le <strong>Chapelier Fou</strong>, le <strong>Lapin </strong>press??, le <strong>Chat du Cheshire</strong>, la <strong>Chenille</strong>???<br><br></div><div>Mais pas que ! Des figures plus inattendues telles que le <strong>Petit Chaperon Rouge</strong>, <strong>Pinocchio</strong>, le <strong>Grand M??chant Loup</strong> ou encore la poup??e <strong>Barbie </strong>sont convoqu??es dans ce voyage vers les contr??es merveilleuses de l???imagination. Ils s???immiscent tour ?? tour dans l???histoire d???Alice et dans un univers o?? tout est possible...</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2019',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::ALICE,
            ],
            [
                'name' => 'Cabaretto',
                'description' => "<div>Au Cabaretto, c???est l???heure de la r??p??tition du grand num??ro de ce soir, mais les musiciens roupillent, <strong>Flamenca</strong>, ??la dompteuse de poussi??re?? n???a d???autre volont?? que de pourchasser <strong>Topoline</strong>, la souris g??ante et <strong>Pipo </strong>et <strong>Pochette </strong>sont en retard, plus d??sireux de se d??clarer leur amour que de travailler.</div>",
                'date_start' => null,
                'date_end' => null,
                'year' => '2021',
                'playStatus' => PlayStatusEnum::CLOSED,
                'ref' => self::CABARETTO,
            ],
            [
                'name' => 'Peter Pan',
                'description' => "<div><strong>Peter Pan</strong> est un petit gar??on qui refuse de grandir.<br><br></div><div>Un jour, il rend visite ?? <strong>Wendy</strong> dans le c??ur de Londres et la convainc de venir, avec ses fr??res, dans le pays imaginaire.<br><br></div><div>C'est l??-bas que vivent les enfants perdus, la f??e <strong>Clochette</strong> et le redoutable <strong>Capitaine Crochet</strong> l'ennemi, jur?? de <strong>Peter</strong> !</div>",
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
