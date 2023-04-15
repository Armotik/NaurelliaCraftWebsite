<?php

namespace App\Entity;

use App\Repository\InfractionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfractionsRepository::class)]
class Infractions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'infractions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?userIG $targetUUID = null;

    #[ORM\ManyToOne(inversedBy: 'infractions')]
    private ?UserIG $staffUUID = null;

    #[ORM\Column(length: 25)]
    private ?string $type = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $reason = null;

    #[ORM\Column(nullable: true)]
    private ?float $duration = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $endDate = null;

    #[ORM\Column]
    private ?bool $status = null;

    public function __construct()
    {
        $this->status = true;

        $date = new \DateTimeImmutable();
        $date->setTimezone(new \DateTimeZone('Europe/Paris'));
        $this->date = $date;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTargetUUID(): ?userIG
    {
        return $this->targetUUID;
    }

    public function setTargetUUID(?userIG $targetUUID): self
    {
        $this->targetUUID = $targetUUID;

        return $this;
    }

    public function getStaffUUID(): ?UserIG
    {
        return $this->staffUUID;
    }

    public function setStaffUUID(?UserIG $staffUUID): self
    {
        $this->staffUUID = $staffUUID;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeImmutable $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
