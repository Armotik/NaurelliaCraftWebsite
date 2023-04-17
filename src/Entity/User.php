<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Ulid;
use Symfony\Component\Validator\Constraints\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
#[UniqueEntity(fields: ['mail'], message: 'There is already an account with this mail')]
#[UniqueEntity(fields: ['code'], message: 'There is already an account with this code')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(type: Types::STRING)]
    private string $password = '';

    #[ORM\Column(type: Types::STRING,length: 255)]
    private ?string $mail = null;

    #[ORM\Column(type: Types::GUID, unique: true)]
    private ?string $code = null;


    #[ORM\Column(type: 'boolean')]
    private ?bool $isLinked = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $skinURL = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: false)]
    private ?DateTimeImmutable $createdAt = null;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->code = new Ulid();
        $this->isLinked = false;

        $date = new DateTimeImmutable();
        $date->setTimezone(new \DateTimeZone('Europe/Paris'));
        $this->createdAt = $date;
    }

    /**
     * Get the value of id
     * @see UserInterface
     * @return int|null The user id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of username
     * @see UserInterface
     * @return string|null The user username
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     * @param string $username The user username
     * @return self The user
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     * @see UserInterface
     * @return string The user username
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * Get the value of roles
     * @see UserInterface
     * @return array The user roles
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Set the value of roles
     * @param array $roles The user roles
     * @return self The user
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get the value of password
     * @see PasswordAuthenticatedUserInterface
     * @return string The user password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     * @param string $password The user password
     * @return self The user
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Get the value of mail
     * @see UserInterface
     * @return string|null The user mail
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     * @param string $mail The user mail
     * @return self The user
     */
    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of code
     * @see UserInterface
     * @return string|null The user code
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Set the value of code
     * @param string $code The user code
     * @return self The user
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of isLinked
     * @see UserInterface
     * @return bool|null
     */
    public function isIsLinked(): ?bool
    {
        return $this->isLinked;
    }

    /**
     * Set the value of isLinked
     * @param bool $isLinked The user isLinked
     * @return self The user
     */
    public function setIsLinked(bool $isLinked): self
    {
        $this->isLinked = $isLinked;

        return $this;
    }

    /**
     * Get the value of isVerified
     * @see UserInterface
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    /**
     * Set the value of isVerified
     * @param bool $isVerified The user isVerified
     * @return self The user
     */
    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * Get the value of skinURL
     * @see UserInterface
     * @return string|null The user skinURL
     */
    public function getSkinURL(): ?string
    {
        return $this->skinURL;
    }

    /**
     * Set the value of skinURL
     * @param string $skinURL The user skinURL
     * @return self The user
     */
    public function setSkinURL(?string $skinURL): self
    {
        $this->skinURL = $skinURL;

        return $this;
    }

    /**
     * Get the value of createdAt
     * @return DateTimeImmutable|null The user createdAt
     *@see UserInterface
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     * @param DateTimeImmutable $createdAt The user createdAt
     * @return self The user
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
