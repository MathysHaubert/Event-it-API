<?php
// src/Entity/Organization.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Organization")
 */
#[ORM\Entity]
#[ORM\Table(name: "Organization")]
class Organization
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
     * @ORM\Column(type="string", length=255)
     */
    #[ORM\Column(type: "string", length: 255)]
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    #[ORM\ManyToOne(targetEntity: "Status")]
    #[ORM\JoinColumn(name: "status_id", referencedColumnName: "id")]
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="organization")
     */
    #[ORM\OneToMany(targetEntity: "User", mappedBy: "organization")]
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Reservation", mappedBy="organization")
     */
    #[ORM\OneToMany(targetEntity: "Reservation", mappedBy: "organization")]
    private $reservations;

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
     * Set the value of id
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the value of name
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get the value of status
     * @return Status|null
     */
    public function getStatus(): ?Status
    {
        return $this->status;
    }

    /**
     * Set the value of status
     * @param Status|null $status
     */
    public function setStatus(?Status $status): void
    {
        $this->status = $status;
    }

    /**
     * Get the value of users
     * @return User[]|Collection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * Add a user to the organization
     * @param User $user
     */
    public function addUser(User $user): void
    {
        $this->users[] = $user;
        $user->setOrganization($this);
    }

    /**
     * Remove a user from the organization
     * @param User $user
     */
    public function removeUser(User $user): void
    {
        $this->users->removeElement($user);
        $user->setOrganization(null);
    }
}