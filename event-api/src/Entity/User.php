<?php
// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "User")]
class User implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private $id;

    #[ORM\Column(type: "datetime",nullable: true)]
    private $lastConnection;

    #[ORM\Column(type: "string", length: 255)]
    private $password;

    #[ORM\Column(type: "string", length: 255)]
    private $email;

    #[ORM\ManyToOne(targetEntity: "Organization")]
    #[ORM\JoinColumn(name: "organization_id", referencedColumnName: "id")]
    private $organization;

    #[ORM\OneToMany(targetEntity: "ForumMessage", mappedBy: "user")]
    private $forumMessages;

    #[ORM\Column(type: "datetime")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private $createdAt;

    #[ORM\Column(type: "string", length: 50)]
    private $firstName;

    #[ORM\Column(type: "string", length: 50)]
    private $lastName;

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
        return $this->lastName;
    }

    /**
     * Set the value of last_name
     * @param string $last_name
     * @return self
     */
    public function setLastName(string $last_name): self
    {
        $this->lastName = $last_name;
        return $this;
    }

    /**
     * Get the value of first_name
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Set the value of first_name
     * @param string $first_name
     * @return self
     */
    public function setFirstName(string $first_name): self
    {
        $this->firstName = $first_name;
        return $this;
    }

    /**
     * Get the value of email
     * @return string|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Set the value of created_at
     * @param \DateTimeInterface $created_at
     * @return self
     */
    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->createdAt = $created_at;
        return $this;
    }

    /**
     * Get the value of organization
     * @return Organization|null
     */
    public function getLastConnection(): ?\DateTimeInterface
    {
        return $this->lastConnection;
    }

    /**
     * Set the value of last_connection
     * @param \DateTimeInterface $last_connection
     * @return self
     */
    public function setLastConnection(\DateTimeInterface $last_connection): self
    {
        $this->lastConnection = $last_connection;
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
     * Get the value of forum_messages
     * @return ForumMessage[]|Collection
     */
    public function getForumMessages(): Collection
    {
        return $this->forumMessages;
    }

    /**
     * Add a forum_message to the user
     * @param ForumMessage $forum_message
     */
    public function addForumMessage(ForumMessage $forum_message): void
    {
        $this->forumMessages[] = $forum_message;
        $forum_message->setUser($this);
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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'lastConnection' => $this->lastConnection,
            'createdAt' => $this->createdAt,
            'password' => $this->password,
            'email' => $this->email,
            'organization' => $this->organization,
        ];
    }
}