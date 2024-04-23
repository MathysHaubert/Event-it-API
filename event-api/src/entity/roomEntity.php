<?php
// src/Entity/Room.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Room")
 */
#[ORM\Entity]
#[ORM\Table(name: "Room")]
class Room
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
    private $location;

    /**
     * @ORM\Column(type="datetime")
     */
    #[ORM\Column(type: "datetime")]
    private $integrated_at;

    /**
     * @ORM\OneToMany(targetEntity="Reservation", mappedBy="room")
     */
    #[ORM\OneToMany(targetEntity: "Reservation", mappedBy: "room")]
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity="Capteurs", mappedBy="room")
     */
    #[ORM\OneToMany(targetEntity: "Capteurs", mappedBy: "room")]
    private $capteurs;

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
     * Get the value of location
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * Set the value of location
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * Get the value of integrated_at
     * @return \DateTimeInterface|null
     */
    public function getIntegratedAt(): ?\DateTimeInterface
    {
        return $this->integrated_at;
    }

    /**
     * Set the value of integrated_at
     * @param \DateTimeInterface $integrated_at
     */
    public function setIntegratedAt(\DateTimeInterface $integrated_at): void
    {
        $this->integrated_at = $integrated_at;
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
     * Add a reservation
     * @param Reservation $reservation
     */
    public function addReservation(Reservation $reservation): void
    {
        $this->reservations[] = $reservation;
        $reservation->setRoom($this);
    }

    /**
     * Remove a reservation
     * @param Reservation $reservation
     */
    public function removeReservation(Reservation $reservation): void
    {
        $this->reservations->removeElement($reservation);
        $reservation->setRoom(null);
    }

    /**
     * Get the value of capteurs
     * @return Capteurs[]|Collection
     */
    public function getCapteurs(): Collection
    {
        return $this->capteurs;
    }

    /**
     * Add a capteur
     * @param Capteurs $capteur
     */
    public function addCapteur(Capteurs $capteur): void
    {
        $this->capteurs[] = $capteur;
        $capteur->setRoom($this);
    }

    /**
     * Remove a capteur
     * @param Capteurs $capteur
     */
    public function removeCapteur(Capteurs $capteur): void
    {
        $this->capteurs->removeElement($capteur);
        $capteur->setRoom(null);
    }
}