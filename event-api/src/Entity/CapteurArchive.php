<?php
// src/Entity/CapteurArchiveEntity.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Capteur_Archive")]
class CapteurArchive
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private $id;

    #[ORM\Column(type: "float", name: "valeur_moyenne_capteur")]
    private $meanValue;

    #[ORM\Column(type: "float", name: "valeur_max_capteur")]
    private $maxValue;

    #[ORM\Column(type: "float", name: "valeur_min_capteur")]
    private $minValue;

    #[ORM\JoinColumn(name: "reservation_id", referencedColumnName: "id")]
    #[ORM\ManyToOne(targetEntity: "Reservation")]
    private $reservation;

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
     * Get the value of meanValue
     * @return float|null
     */
    public function getMeanValue(): ?float
    {
        return $this->meanValue;
    }

    /**
     * Set the value of meanValue
     * @param float $meanValue
     */
    public function setMeanValue(float $meanValue): void
    {
        $this->meanValue = $meanValue;
    }

    /**
     * Get the value of maxValue
     * @return float|null
     */
    public function getMaxValue(): ?float
    {
        return $this->maxValue;
    }

    /**
     * Set the value of maxValue
     * @param float $maxValue
     */
    public function setMaxValue(float $maxValue): void
    {
        $this->maxValue = $maxValue;
    }

    /**
     * Get the value of minValue
     * @return float|null
     */
    public function getMinValue(): ?float
    {
        return $this->minValue;
    }

    /**
     * Set the value of minValue
     * @param float $minValue
     */
    public function setMinValue(float $minValue): void
    {
        $this->minValue = $minValue;
    }

    /**
     * Get the value of reservation
     * @return Reservation|null
     */
    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    /**
     * Set the value of reservation
     * @param Reservation|null $reservation
     */
    public function setReservation(?Reservation $reservation): void
    {
        $this->reservation = $reservation;
    }
}
