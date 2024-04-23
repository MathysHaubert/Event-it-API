<?php
// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
#[ORM\Entity]
#[ORM\Table(name: "User")]
class User implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    #[ORM\Column(type: "datetime")]
    private $last_connection;

    /**
     * @ORM\ManyToOne(targetEntity="Organization")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    #[ORM\ManyToOne(targetEntity: "Organization")]
    #[ORM\JoinColumn(name: "client_id", referencedColumnName: "id")]
    private $client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[ORM\Column(type: "string", length: 255)]
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[ORM\Column(type: "string", length: 255)]
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     */
    #[ORM\ManyToOne(targetEntity: "Status")]
    #[ORM\JoinColumn(name: "organization_id", referencedColumnName: "id")]
    private $organization;

    // getters and setters

    /**
     * Get the value of id
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of last_connection
     * @return \DateTimeInterface|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     * @param string $last_name
     * @return self
     */
    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * Get the value of first_name
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     * @param string $first_name
     * @return self
     */
    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * Get the value of email
     * @return string|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     * @param \DateTimeInterface $created_at
     * @return self
     */
    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * Get the value of organization
     * @return Organization|null
     */
    public function getLastConnection(): ?\DateTimeInterface
    {
        return $this->last_connection;
    }

    /**
     * Set the value of last_connection
     * @param \DateTimeInterface $last_connection
     * @return self
     */
    public function setLastConnection(\DateTimeInterface $last_connection): self
    {
        $this->last_connection = $last_connection;
        return $this;
    }

    /**
     * Get the value of client
     * @return Organization|null
     */
    public function getClientId(): ?int
    {
        return $this->client_id;
    }

    /**
     * Set the value of client_id
     * @param int $client_id
     * @return self
     */
    public function setClientId(int $client_id): self
    {
        $this->client_id = $client_id;
        return $this;
    }

    /**
     * Get the value of password
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     * @param string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the value of email
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of organization
     * @return Status|null
     */
    public function getOrganizationId(): ?int
    {
        return $this->organization_id;
    }

    /**
     * Set the value of organization_id
     * @param int $organization_id
     * @return self
     */
    public function setOrganizationId(int $organization_id): self
    {
        $this->organization_id = $organization_id;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'last_connection' => $this->last_connection,
            'client' => $this->client,
            'password' => $this->password,
            'email' => $this->email,
            'organization' => $this->organization,
        ];
    }
}