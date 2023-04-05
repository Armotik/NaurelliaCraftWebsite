<?php

namespace App\Entity;

use App\Repository\InfractionsIGRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfractionsIGRepository::class)]
class InfractionsIG
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $infractionId = null;

    #[ORM\ManyToOne(inversedBy: 'infractionsIGs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UsersIG $targetUUID = null;

    #[ORM\Column(length: 30)]
    private ?string $infractionType = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $reason = null;

    #[ORM\Column(nullable: true)]
    private ?float $duration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endInfraction = null;

    #[ORM\ManyToOne(inversedBy: 'infractionsIGs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UsersIG $staffUUID = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $infractionDate = null;

    #[ORM\Column]
    private ?bool $infractionStatus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInfractionId(): ?int
    {
        return $this->infractionId;
    }

    public function setInfractionId(int $infractionId): self
    {
        $this->infractionId = $infractionId;

        return $this;
    }

    public function getTargetUUID(): ?UsersIG
    {
        return $this->targetUUID;
    }

    public function setTargetUUID(?UsersIG $targetUUID): self
    {
        $this->targetUUID = $targetUUID;

        return $this;
    }

    public function getInfractionType(): ?string
    {
        return $this->infractionType;
    }

    public function setInfractionType(string $infractionType): self
    {
        $this->infractionType = $infractionType;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(?float $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getEndInfraction(): ?\DateTimeInterface
    {
        return $this->endInfraction;
    }

    public function setEndInfraction(?\DateTimeInterface $endInfraction): self
    {
        $this->endInfraction = $endInfraction;

        return $this;
    }

    public function getStaffUUID(): ?UsersIG
    {
        return $this->staffUUID;
    }

    public function setStaffUUID(?UsersIG $staffUUID): self
    {
        $this->staffUUID = $staffUUID;

        return $this;
    }

    public function getInfractionDate(): ?\DateTimeInterface
    {
        return $this->infractionDate;
    }

    public function setInfractionDate(\DateTimeInterface $infractionDate): self
    {
        $this->infractionDate = $infractionDate;

        return $this;
    }

    public function isInfractionStatus(): ?bool
    {
        return $this->infractionStatus;
    }

    public function setInfractionStatus(bool $infractionStatus): self
    {
        $this->infractionStatus = $infractionStatus;

        return $this;
    }
}
