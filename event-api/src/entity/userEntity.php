<?php
// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
#[ORM\Entity]
#[ORM\Table(name: "User")]
class User
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
     * @ORM\ManyToOne(targetEntity="Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     */
    #[ORM\ManyToOne(targetEntity: "Organization")]
    #[ORM\JoinColumn(name: "organization_id", referencedColumnName: "id")]
    private $organization;

    /**
     * @ORM\OneToMany(targetEntity="Forum_message", mappedBy="user")
     */
    #[ORM\OneToMany(targetEntity: "Forum_message", mappedBy: "user")]
    private $forum_messages;

    /**
     * @ORM\Column(type="DateTime")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    #[ORM\Column(type: "DateTime")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private $created_at;

    /**
     * @ORM\Column(type="string", length=50)
     */
    #[ORM\Column(type: "string", length: 50)]
    private $first_name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    #[ORM\Column(type: "string", length: 50)]
    private $last_name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    #[ORM\Column(type: "string", length: 50)]
    private $role;

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

    /**
     * Get the value of organization
     * @return Organization|null
     */
    public function getOrganization(): ?Organization
    {
        return $this->organization;
    }

    /**
     * Set the value of organization
     * @param Organization|null $organization
     * @return self
     */
    public function setOrganization(?Organization $organization): self
    {
        $this->organization = $organization;
        return $this;
    }

    /**
     * Get the value of role
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     * @param string $role
     * @return self
     */
    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }
}