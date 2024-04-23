<?php
// src/Entity/Reservation.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Reservation")
 */
#[ORM\Entity]
#[ORM\Table(name: "Reservation")]
class Reservation
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
     * @ORM\Column(type="date")
     */
    #[ORM\Column(type: "date")]
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    #[ORM\Column(type: "datetime", name: "end_at")]
    private $endAt;

    /**
     * @ORM\OneToMany(targetEntity="Capteur_Archive", mappedBy="reservation")
     */
    #[ORM\OneToMany(targetEntity: "Capteur_Archive", mappedBy: "reservation")]
    private $capteur_archives;

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
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of date
     * @return \DateTimeInterface|null
     */ 
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * Set the value of date
     * @param \DateTimeInterface $date
     * @return self
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get the value of time
     * @return \DateTimeInterface|null
     */ 
    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    /**
     * Set the value of time
     * @param \DateTimeInterface $time
     * @return self
     */
    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Get the value of room
     * @return Room|null
     */ 
    public function getRoom(): ?Room
    {
        return $this->room;
    }

    /**
     * Set the value of room
     * @param Room|null $room
     * @return self
     */
    public function setRoom(?Room $room): self
    {
        $this->room = $room;
        return $this;
    }
}