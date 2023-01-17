<?php

namespace App\Entity\Site;

use App\Entity\Site\Play;
use Doctrine\DBAL\Types\Types;
use App\Entity\EasyMedia\Media;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlayGalleryRepository;

#[ORM\Entity(repositoryClass: PlayGalleryRepository::class)]
class PlayGallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playGalleries')]
    private ?Play $play = null;

    #[ORM\Column(type: 'easy_media_type', nullable: true)]
    private Media|int|null $image = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $position = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlay(): ?Play
    {
        return $this->play;
    }

    public function setPlay(?Play $play): self
    {
        $this->play = $play;

        return $this;
    }

    public function getImage(): int|Media|null
    {
        return $this->image;
    }

    public function setImage(int|Media|null $image)
    {
        $this->image = $image;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function __toString() {
        $position = $this->position ?? ' --- ';
        return 'Image - Position nº ' . $position;
    }
}
