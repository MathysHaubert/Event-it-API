<?php
// src/Entity/Room.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "Room")]
class Room implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private $location;

    #[ORM\Column(type: "datetime")]
    private $integrated_at;

    #[ORM\OneToMany(targetEntity: "Reservation", mappedBy: "room")]
    private $reservations;

    #[ORM\OneToMany(targetEntity: "Capteur", mappedBy: "room")]
    private $capteur;

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
     * @return Capteurs[]|Collection|null
     */
    public function getCapteur(): Collection | null
    {
        return $this->capteur ?? null;
    }

    /**
     * Add a capteur
     * @param Capteurs $capteur
     */
    public function addCapteur(Capteur $capteur): void
    {
        $this->capteur[] = $capteur;
        $capteur->setRoom($this);
    }

    /**
     * Remove a capteur
     * @param Capteurs $capteur
     */
    public function removeCapteur(Capteur $capteur): void
    {
        $this->capteur->removeElement($capteur);
        $capteur->setRoom(null);
    }

    public function jsonSerialize(): mixed
    {

        if($this->getCapteur() === null){
            $capteurs = null;
        } else{
            $capteurs = [];
            foreach ($this->getCapteur() as $capteur) {
                $capteurs[] = $capteur->getId();
            }
        }

        if($this->reservations === null){
            $reservations = null;
        } else{
            $reservations = [];
            foreach ($this->getReservations() as $reservation) {
                $reservations[] = $reservation->getId();
            }
        }

        return [
            'id' => $this->id,
            'location' => $this->location,
            'reservations' => $reservations,
            'capteurs' => $capteurs,
        ];
    }
}