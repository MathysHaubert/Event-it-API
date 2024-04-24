<?php
// src/Entity/Organization.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "Organization")]
class Organization
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private $name;

    #[ORM\OneToMany(targetEntity: "User", mappedBy: "organization")]
    private $users;

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

    /**
     * Get the value of reservations
     * @return Reservation[]|Collection
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    /**
     * Add a reservation to the organization
     * @param Reservation $reservation
     */
    public function addReservation(Reservation $reservation): void
    {
        $this->reservations[] = $reservation;
        $reservation->setOrganization($this);
    }
}