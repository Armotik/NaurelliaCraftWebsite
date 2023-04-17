<?php

namespace App\Entity;

use App\Repository\UserIGRepository;
use DateTimeImmutable;
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
    private ?DateTimeImmutable $firstJoinAt = null;

    #[ORM\Column]
    private ?DateTimeImmutable $lastJoinAt = null;

    #[ORM\Column]
    private ?bool $isOnline = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $ranks = [];

    #[ORM\Column]
    private ?bool $isOp = null;

    #[ORM\OneToMany(mappedBy: 'targetUUID', targetEntity: Infractions::class)]
    private Collection $infractions;

    /**
     * UserIG constructor.
     */
    public function __construct()
    {
        $date = new DateTimeImmutable();
        $date->setTimezone(new \DateTimeZone('Europe/Paris'));
        $this->firstJoinAt = $date;

        //same date for the moment
        $this->lastJoinAt = $date;

        $this->isOnline = true;
        $this->isOp = false;

        $this->infractions = new ArrayCollection();
    }

    /**
     * Get the value of id
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of uuid
     * @return string|null
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * Set the value of uuid
     * @param string $uuid
     * @return self The UserIG
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get the value of username
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     * @param string $username
     * @return self The UserIG
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of firstJoinAt
     * @return DateTimeImmutable|null
     */
    public function getFirstJoinAt(): ?DateTimeImmutable
    {
        return $this->firstJoinAt;
    }

    /**
     * Set the value of firstJoinAt
     * @param DateTimeImmutable $firstJoinAt
     * @return self The UserIG
     */
    public function setFirstJoinAt(DateTimeImmutable $firstJoinAt): self
    {
        $this->firstJoinAt = $firstJoinAt;

        return $this;
    }

    /**
     * Get the value of lastJoinAt
     * @return DateTimeImmutable|null
     */
    public function getLastJoinAt(): ?DateTimeImmutable
    {
        return $this->lastJoinAt;
    }

    /**
     * Set the value of lastJoinAt
     * @param DateTimeImmutable $lastJoinAt
     * @return self The UserIG
     */
    public function setLastJoinAt(DateTimeImmutable $lastJoinAt): self
    {
        $this->lastJoinAt = $lastJoinAt;

        return $this;
    }

    /**
     * Get the value of isOnline
     * @return bool|null
     */
    public function isIsOnline(): ?bool
    {
        return $this->isOnline;
    }

    /**
     * Set the value of isOnline
     * @param bool $isOnline
     * @return self The UserIG
     */
    public function setIsOnline(bool $isOnline): self
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    /**
     * Get the value of ranks
     * @return array The ranks
     */
    public function getRanks(): array
    {
        return $this->ranks;
    }

    /**
     * Set the value of ranks
     * @param array $ranks The ranks
     * @return self The UserIG
     */
    public function setRanks(array $ranks): self
    {
        $this->ranks = $ranks;

        return $this;
    }

    /**
     * Get the value of isOp
     * @return bool|null The isOp value
     */
    public function isIsOp(): ?bool
    {
        return $this->isOp;
    }

    /**
     * Set the value of isOp
     * @param bool $isOp The isOp
     * @return self The UserIG
     */
    public function setIsOp(bool $isOp): self
    {
        $this->isOp = $isOp;

        return $this;
    }

    /**
     * Get the value of infractions collection
     * @return Collection<int, Infractions>
     */
    public function getInfractions(): Collection
    {
        return $this->infractions;
    }

    /**
     * Add an infraction to the infractions collection
     * @param Infractions $infraction The infraction to add
     * @return $this The UserIG
     */
    public function addInfraction(Infractions $infraction): self
    {
        if (!$this->infractions->contains($infraction)) {
            $this->infractions->add($infraction);
            $infraction->setTargetUUID($this);
        }

        return $this;
    }

    /**
     * Remove an infraction from the infractions collection
     * @param Infractions $infraction The infraction to remove
     * @return $this The UserIG
     */
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
