<?php

namespace App\Entity;

use App\Repository\ShopItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShopItemRepository::class)]
#[ORM\UniqueConstraint(fields: ['reference', 'designation'])]
class ShopItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $designation = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?bool $onShop = null;

    #[ORM\ManyToMany(targetEntity: UserIG::class, mappedBy: 'ranks')]
    private Collection $userIGs;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $advantages = [];

    public function __construct()
    {

        $this->onShop = true;
        $this->userIGs = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function isOnShop(): ?bool
    {
        return $this->onShop;
    }

    public function setOnShop(bool $onShop): self
    {
        $this->onShop = $onShop;

        return $this;
    }

    /**
     * @return Collection<int, UserIG>
     */
    public function getUserIGs(): Collection
    {
        return $this->userIGs;
    }

    public function addUserIG(UserIG $userIG): self
    {
        if (!$this->userIGs->contains($userIG)) {
            $this->userIGs->add($userIG);
            $userIG->addRank($this);
        }

        return $this;
    }

    public function removeUserIG(UserIG $userIG): self
    {
        if ($this->userIGs->removeElement($userIG)) {
            $userIG->removeRank($this);
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdvantages(): array
    {
        return $this->advantages;
    }

    public function setAdvantages(?array $advantages): self
    {
        $this->advantages = $advantages;

        return $this;
    }
}
