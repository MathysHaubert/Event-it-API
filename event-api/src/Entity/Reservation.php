<?php
// src/Entity/Reservation.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "Reservation")]
class Reservation implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\ManyToOne(targetEntity: "Organization")]
    #[ORM\JoinColumn(nullable: false)]
    private $organization;

    #[ORM\Column(type: "datetime")]
    private $startAt;

    #[ORM\Column(type: "datetime")]
    private $endAt;

    #[ORM\ManyToOne(targetEntity: "Room", inversedBy: "reservations")]
    #[ORM\JoinColumn(name: "room_id", referencedColumnName: "id")]
    private $room;

    #[ORM\OneToMany(targetEntity: "CapteurArchive", mappedBy: "reservation")]
    private $capteurArchive;

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
     */
    public function setOrganization(?Organization $organization): self
    {
        $this->organization = $organization;
        return $this;
    }

    /**
     * Get the value of startAt
     * @return \DateTimeInterface|null
     */
    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    /**
     * Set the value of startAt
     * @param \DateTimeInterface $startAt
     */
    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;
        return $this;
    }

    /**
     * Get the value of endAt
     * @return \DateTimeInterface|null
     */
    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    /**
     * Set the value of endAt
     * @param \DateTimeInterface $endAt
     */
    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;
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
     */
    public function setRoom(?Room $room): self
    {
        $this->room = $room;
        return $this;
    }

    /**
     * Get the value of capteurArchive
     * @return CapteurArchive[]|Collection|null
     */
    public function getCapteurArchive(): Collection | null
    {
        return $this->capteurArchive;
    }

    /**
     * Set the value of capteurArchive
     * @param CapteurArchive[]|Collection|null $capteurArchive
     */
    public function setCapteurArchive(Collection | null $capteurArchive): self
    {
        $this->capteurArchive = $capteurArchive;
        return $this;
    }

    public function jsonSerialize()
    {
        if($this->getCapteurArchive()===null){
            $capteursArchive = null;
        }

        else{
            $capteursArchive = [];
            foreach($this->getCapteurArchive() as $capteurArchive){
                $capteursArchive[] = $capteurArchive->jsonSerialize();
            }
        }

        return [
            'id' => $this->id,
            'organization' => $this->organization,
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'room' => $this->room,
            'capteurArchive' => $capteursArchive
        ];
    }
}