<?php

namespace App\DataFixtures\Entities;

//use App\Entity\Blog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $arrayData = $this->getData();
        // foreach ($arrayData as $array) {
        //     $data = new Blog();
        //     $data->setTitle($array['title'] ?? null);
        //     $data->setYear($array['year'] ?? null);
        //     $data->setDescription($array['description'] ?? null);
        //     $data->setImagePath($array['image_path'] ?? null);
        //     $manager->persist($data);
        // }
        // $manager->flush();
    }

    public function getData(): array
    {
        return [
            [
                'title' => 'Journal DNA', 
                'year' => '2008', 
                'description' => '<p>Un article dans le journal DNA annon&ccedil;ant notre premi&egrave;re repr&eacute;sentation &laquo;<strong>Le m&eacute;tro m&eacute; pas tro</strong>&raquo;.</p>', 
                'image_path' => '2008.jpeg',
            ],
            [
                'title' => 'Journal DNA', 
                'year' => '2013', 
                'description' => '<p>Annonce de l\'arriv&eacute;e de notre tourn&eacute;e &agrave; Seltz, avec la pi&egrave;ce "<strong>Les aventures de Phil&eacute;as Fogg</strong>", avec notre troupe des plus grands.</p>', 
                'image_path' => '2013_dna.jpeg',
            ],
            [
                'title' => 'Médiathèque', 
                'year' => '2014', 
                'description' => '<p>Participation &agrave; l\'inauguration de la M&eacute;diath&egrave;que de Wisches avec la pr&eacute;sence de notre Parrain <strong>Medhi El Glaoui</strong>.</p>', 
                'image_path' => '2014-mediateca.jpeg',
            ],
            [
                'title' => 'Sortie Bubble Foot', 
                'year' => '2018', 
                'description' => '&lt;p&gt;Comme d\'habitude, pour clore la fin de la saison, cette ann&amp;eacute;e nous avons d&amp;eacute;cid&amp;eacute; de la f&amp;ecirc;ter avec un jeu de &lt;strong&gt;Bubble Foot&lt;/strong&gt;!&lt;/p&gt;', 
                'image_path' => '2018-SortieBubbleFoot.jpeg',
            ],
            [
                'title' => 'Forum de la jeunesse et des associations', 
                'year' => '2019', 
                'description' => '&lt;p&gt;Participation au Forum, principalement destin&amp;eacute; aux &amp;eacute;tudiants, &amp;agrave; la diffusion et &amp;agrave; l\'information sur divers sujets.&lt;/p&gt;', 
                'image_path' => '2019-Forum.jpeg',
            ],
            [
                'title' => 'Sortie Trampoline', 
                'year' => '2019', 
                'description' => '&lt;p&gt;La &quot;&lt;strong&gt;Teampoline&lt;/strong&gt;&quot; a f&amp;ecirc;t&amp;eacute; la fin de cette saison avec de superbes sauts et de belles acrobaties!&lt;/p&gt;', 
                'image_path' => '2019-SortieTrampoline.jpeg',
            ],
            [
                'title' => 'Peter Pan', 
                'year' => '2022', 
                'description' => '', 
                'image_path' => '636e6e4687f4f3_21194784.jpeg',
            ],
        ];
    }
}
