<?php
// src/Entity/Status.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Status")
 */
#[ORM\Entity]
#[ORM\Table(name: "Status")]
class Status
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="status")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    #[ORM\ManyToOne(targetEntity: "User", inversedBy: "status")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private $userId;


    // getters and setters

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}