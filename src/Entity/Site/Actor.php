<?php

namespace App\Entity\Site;

use App\Entity\Site\PlayActorRole;
use App\Trait\ObjectStateEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ActorRepository;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $firstname = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $respFirstname = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $respLastname = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $respPhone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $respEmail = null;

    #[ORM\Column(length: 15)]
    private ?string $state = ObjectStateEnum::ENABLED;

    #[ORM\OneToMany(mappedBy: 'actor', targetEntity: PlayActorRole::class, orphanRemoval: true)]
    private Collection $playActorRoles;

    public function __construct()
    {
        $this->playActorRoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = ucfirst($firstname);

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = mb_strtoupper($lastname);

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRespFirstname(): ?string
    {
        return $this->respFirstname;
    }

    public function setRespFirstname(?string $respFirstname): self
    {
        $this->respFirstname = ucfirst($respFirstname);

        return $this;
    }

    public function getRespLastname(): ?string
    {
        return $this->respLastname;
    }

    public function setRespLastname(?string $respLastname): self
    {
        $this->respLastname = mb_strtoupper($respLastname);

        return $this;
    }

    public function getRespPhone(): ?string
    {
        return $this->respPhone;
    }

    public function setRespPhone(?string $respPhone): self
    {
        $this->respPhone = $respPhone;

        return $this;
    }

    public function getRespEmail(): ?string
    {
        return $this->respEmail;
    }

    public function setRespEmail(?string $respEmail): self
    {
        $this->respEmail = $respEmail;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection<int, PlayActorRole>
     */
    public function getPlayActorRoles(): Collection
    {
        return $this->playActorRoles;
    }

    public function addPlayActorRole(PlayActorRole $playActorRole): self
    {
        if (!$this->playActorRoles->contains($playActorRole)) {
            $this->playActorRoles->add($playActorRole);
            $playActorRole->setActor($this);
        }

        return $this;
    }

    public function removePlayActorRole(PlayActorRole $playActorRole): self
    {
        if ($this->playActorRoles->removeElement($playActorRole)) {
            // set the owning side to null (unless already changed)
            if ($playActorRole->getActor() === $this) {
                $playActorRole->setActor(null);
            }
        }

        return $this;
    }

    // **************************************************************

    public function getFullname(): ?string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getRespFullname(): ?string
    {
        return $this->respFirstname . ' ' . $this->respLastname;
    }

    public function __toString()
    {
        return $this->getFullname();
    }


}
