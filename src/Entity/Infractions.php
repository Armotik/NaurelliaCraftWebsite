<?php

namespace App\Entity;

use App\Repository\InfractionsRepository;
use DateTimeImmutable;
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
    private ?DateTimeImmutable $date = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?DateTimeImmutable $endDate = null;

    #[ORM\Column]
    private ?bool $status = null;

    /**
     * Infractions constructor.
     */
    public function __construct()
    {
        $this->status = true;

        $date = new DateTimeImmutable();
        $date->setTimezone(new \DateTimeZone('Europe/Paris'));
        $this->date = $date;
    }

    /**
     * Get the value of id
     * @return int|null The id of the infraction
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of targetUUID
     * @return userIG|null The target of the infraction
     */
    public function getTargetUUID(): ?userIG
    {
        return $this->targetUUID;
    }

    /**
     * Set the value of targetUUID
     * @param userIG|null $targetUUID The target of the infraction
     * @return self The infraction
     */
    public function setTargetUUID(?userIG $targetUUID): self
    {
        $this->targetUUID = $targetUUID;

        return $this;
    }

    /**
     * Get the value of staffUUID
     * @return UserIG|null The staff member who issued the infraction
     */
    public function getStaffUUID(): ?UserIG
    {
        return $this->staffUUID;
    }

    /**
     * Set the value of staffUUID
     * @param UserIG|null $staffUUID The staff member who issued the infraction
     * @return self The infraction
     */
    public function setStaffUUID(?UserIG $staffUUID): self
    {
        $this->staffUUID = $staffUUID;

        return $this;
    }

    /**
     * Get the value of type
     * @return string|null The type of the infraction
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     * @param string $type The type of the infraction
     * @return self The infraction
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of reason
     * @return string|null The reason of the infraction
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * Set the value of reason
     * @param string|null $reason The reason of the infraction
     * @return self The infraction
     */
    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get the value of duration
     * @return float|null The duration of the infraction
     */
    public function getDuration(): ?float
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     * @param float|null $duration The duration of the infraction
     * @return self The infraction
     */
    public function setDuration(?float $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of date
     * @return DateTimeImmutable|null The date of the infraction
     */
    public function getDate(): ?DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * Set the value of date
     * @param DateTimeImmutable $date The date of the infraction
     * @return self The infraction
     */
    public function setDate(DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of endDate
     * @return DateTimeImmutable|null The end date of the infraction
     */
    public function getEndDate(): ?DateTimeImmutable
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     * @param DateTimeImmutable|null $endDate The end date of the infraction
     * @return self The infraction
     */
    public function setEndDate(?DateTimeImmutable $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the value of status
     * @return bool|null The status of the infraction
     */
    public function isStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * Set the value of status
     * @param bool $status The status of the infraction
     * @return self The infraction
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
