<?php
// src/Entity/Capteurs.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Capteurs")
 */
#[ORM\Entity]
#[ORM\Table(name: "Capteurs")]
class Capteurs
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
    #[ORM\Column(type: "time")]
    private $time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[ORM\Column(type: "string", length: 255)]
    private $type;

    /**
     * @ORM\Column(type="float")
     */
    #[ORM\Column(type: "float")]
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="Room")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     */
    #[ORM\ManyToOne(targetEntity: "Room")]
    #[ORM\JoinColumn(name: "room_id", referencedColumnName: "id")]
    private $room;

    // getters and setters

        /**
         * Get the value of id
         * @return int|null
         */ 
        public function getId()
        {
            return $this->id;
        }

        /**
         * Get the value of date
         * @return string|null
         */ 
        public function getDate()
        {
            return $this->date;
        }

        /**
         * Set the value of date
         * @return  self
         */ 
        public function setDate($date)
        {
            $this->date = $date;

            return $this;
        }

        /**
         * Get the value of time
         * @return string|null
         */ 
        public function getTime()
        {
            return $this->time;
        }

        /**
         * Set the value of time
         * @return  self
         */ 
        public function setTime($time)
        {
            $this->time = $time;

            return $this;
        }

        /**
         * Get the value of type
         * @return string|null
         */ 
        public function getType()
        {
            return $this->type;
        }

        /**
         * Set the value of type
         * @return  self
         */ 
        public function setType($type)
        {
            $this->type = $type;

            return $this;
        }

        /**
         * Get the value of value
         * @return float|null
         */ 
        public function getValue()
        {
            return $this->value;
        }

        /**
         * Set the value of value
         * @return  self
         */ 
        public function setValue($value)
        {
            $this->value = $value;

            return $this;
        }

        /**
         * Get the value of room
         * @return Room|null
         */ 
        public function getRoom()
        {
            return $this->room;
        }

        /**
         * Set the value of room
         * @return  self
         */ 
        public function setRoom($room)
        {
            $this->room = $room;

            return $this;
        }
}