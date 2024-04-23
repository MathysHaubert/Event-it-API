<?php
// src/Entity/Status.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Status")]
class Status
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: "User")]
    private $user;

    #[ORM\ManyToOne(targetEntity: "Organization")]
    private $organizations;

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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of organizations
     * @return Organization
     */
    public function getOrganizations()
    {
        return $this->organizations;
    }

    /**
     * Set the value of organizations
     * @param Organization $organizations
     * @return self
     */
    public function setOrganizations($organizations)
    {
        $this->organizations = $organizations;
        return $this;
    }
}