<?php

namespace App\Entity;

use App\Repository\UserIGRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserIGRepository::class)]
class UserIG
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::GUID)]
    private ?string $uuid = null;

    #[ORM\Column(length: 50)]
    private ?string $username = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $firstJoinAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $lastJoinAt = null;

    #[ORM\Column]
    private ?bool $isOnline = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $ranks = [];

    #[ORM\Column]
    private ?bool $isOp = null;

    #[ORM\OneToMany(mappedBy: 'targetUUID', targetEntity: Infractions::class)]
    private Collection $infractions;

    public function __construct()
    {
        $date = new \DateTimeImmutable();
        $date->setTimezone(new \DateTimeZone('Europe/Paris'));
        $this->firstJoinAt = $date;

        //same date for the moment
        $this->lastJoinAt = $date;

        $this->isOnline = true;
        $this->isOp = false;

        $this->infractions = new ArrayCollection();
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

    public function getFirstJoinAt(): ?\DateTimeImmutable
    {
        return $this->firstJoinAt;
    }

    public function setFirstJoinAt(\DateTimeImmutable $firstJoinAt): self
    {
        $this->firstJoinAt = $firstJoinAt;

        return $this;
    }

    public function getLastJoinAt(): ?\DateTimeImmutable
    {
        return $this->lastJoinAt;
    }

    public function setLastJoinAt(\DateTimeImmutable $lastJoinAt): self
    {
        $this->lastJoinAt = $lastJoinAt;

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

    public function getRanks(): array
    {
        return $this->ranks;
    }

    public function setRanks(array $ranks): self
    {
        $this->ranks = $ranks;

        return $this;
    }

    public function isIsOp(): ?bool
    {
        return $this->isOp;
    }

    public function setIsOp(bool $isOp): self
    {
        $this->isOp = $isOp;

        return $this;
    }

    /**
     * @return Collection<int, Infractions>
     */
    public function getInfractions(): Collection
    {
        return $this->infractions;
    }

    public function addInfraction(Infractions $infraction): self
    {
        if (!$this->infractions->contains($infraction)) {
            $this->infractions->add($infraction);
            $infraction->setTargetUUID($this);
        }

        return $this;
    }

    public function removeInfraction(Infractions $infraction): self
    {
        if ($this->infractions->removeElement($infraction)) {
            // set the owning side to null (unless already changed)
            if ($infraction->getTargetUUID() === $this) {
                $infraction->setTargetUUID(null);
            }
        }

        return $this;
    }
}
