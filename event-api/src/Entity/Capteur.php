<?php
// src/Entity/Capteur.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Capteurs")]
class Capteur implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private $id;

    #[ORM\Column(type: "datetime", name: "taken_at")]
    private $takenAt;

    #[ORM\Column(type: "string", length: 255)]
    private $type;

    #[ORM\Column(type: "float")]
    private $value;

    #[ORM\ManyToOne(targetEntity: "Room", inversedBy: "capteur")]
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
        public function getTakenAt()
        {
            return $this->takenAt;
        }

        /**
         * Set the value of date
         * @return  self
         */ 
        public function setTakenAt($value)
        {
            $this->takenAt = $value;

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

        public function jsonSerialize(): mixed
        {
            return [
                'id' => $this->id,
                'takenAt' => $this->takenAt,
                'type' => $this->type,
                'value' => $this->value,
                'room' => $this->room->getId()
            ];
        }
}