<?php

namespace App\Entity;

use App\Repository\UsersIGRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersIGRepository::class)]
class UsersIG
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::GUID)]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $joinedAt = null;

    #[ORM\Column]
    private ?bool $isOnline = null;

    #[ORM\Column]
    private ?bool $isLinked = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $ranks = [];

    #[ORM\OneToMany(mappedBy: 'targetUUID', targetEntity: InfractionsIG::class)]
    private Collection $infractionsIGs;

    public function __construct()
    {
        $this->infractionsIGs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getJoinedAt(): ?\DateTimeInterface
    {
        return $this->joinedAt;
    }

    public function setJoinedAt(\DateTimeInterface $joinedAt): self
    {
        $this->joinedAt = $joinedAt;

        return $this;
    }

    public function isIsOnline(): ?bool
    {
        return $this->isOnline;
    }

    public function setIsOnline(bool $isOnline): self
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    public function isIsLinked(): ?bool
    {
        return $this->isLinked;
    }

    public function setIsLinked(bool $isLinked): self
    {
        $this->isLinked = $isLinked;

        return $this;
    }

    public function getRanks(): array
    {
        return $this->ranks;
    }

    public function setRanks(?array $ranks): self
    {
        $this->ranks = $ranks;

        return $this;
    }

    /**
     * @return Collection<int, InfractionsIG>
     */
    public function getInfractionsIGs(): Collection
    {
        return $this->infractionsIGs;
    }

    public function addInfractionsIG(InfractionsIG $infractionsIG): self
    {
        if (!$this->infractionsIGs->contains($infractionsIG)) {
            $this->infractionsIGs->add($infractionsIG);
            $infractionsIG->setTargetUUID($this);
        }

        return $this;
    }

    public function removeInfractionsIG(InfractionsIG $infractionsIG): self
    {
        if ($this->infractionsIGs->removeElement($infractionsIG)) {
            // set the owning side to null (unless already changed)
            if ($infractionsIG->getTargetUUID() === $this) {
                $infractionsIG->setTargetUUID(null);
            }
        }

        return $this;
    }
}
