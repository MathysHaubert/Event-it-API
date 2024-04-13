<?php
// src/Entity/Forum_message.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Forum_message")
 */
#[ORM\Entity]
#[ORM\Table(name: "Forum_message")]
class Forum_message
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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    #[ORM\ManyToOne(targetEntity: "User")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Forum")
     * @ORM\JoinColumn(name="forum_id", referencedColumnName="id")
     */
    #[ORM\ManyToOne(targetEntity: "Forum")]
    #[ORM\JoinColumn(name: "forum_id", referencedColumnName: "id")]
    private $forum;

    /**
     * @ORM\Column(type="integer")
     */
    #[ORM\Column(type: "integer")]
    private $like;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[ORM\Column(type: "string", length: 255)]
    private $message;

    /**
     * @ORM\Column(type="boolean")
     */
    #[ORM\Column(type: "boolean")]
    private $resolved;

    /**
     * @ORM\Column(type="boolean")
     */
    #[ORM\Column(type: "boolean")]
    private $primary_message;

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
     * Get the value of user
     * @return User|null
     */ 
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Set the value of user
     * @param User $user
     */ 
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * Get the value of forum
     * @return Forum|null
     */ 
    public function getForum(): ?Forum
    {
        return $this->forum;
    }

    /**
     * Set the value of forum
     * @param Forum $forum
     */ 
    public function setForum(Forum $forum): void
    {
        $this->forum = $forum;
    }

    /**
     * Get the value of like
     * @return int|null
     */ 
    public function getLike(): ?int
    {
        return $this->like;
    }

    /**
     * Set the value of like
     * @param int $like
     */ 
    public function setLike(int $like): void
    {
        $this->like = $like;
    }

    /**
     * Get the value of message
     * @return string|null
     */ 
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Set the value of message
     * @param string $message
     */ 
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * Get the value of resolved
     * @return bool|null
     */ 
    public function isResolved(): ?bool
    {
        return $this->resolved;
    }

    /**
     * Set the value of resolved
     * @param bool $resolved
     */ 
    public function setResolved(bool $resolved): void
    {
        $this->resolved = $resolved;
    }

    /**
     * Get the value of primary_message
     * @return bool|null
     */ 
    public function isPrimaryMessage(): ?bool
    {
        return $this->primary_message;
    }

    /**
     * Set the value of primary_message
     * @param bool $primary_message
     */ 
    public function setPrimaryMessage(bool $primary_message): void
    {
        $this->primary_message = $primary_message;
    }
}