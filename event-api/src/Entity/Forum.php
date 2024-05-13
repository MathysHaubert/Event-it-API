<?php
// src/Entity/Forum.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Forum")]
class Forum implements \JsonSerializable
{
    #[ORM\Column(type: "datetime", name: "last_modified")]
    private $lastModified;

    #[ORM\Id]
    #[ORM\Column(type: "integer", length: 255)]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    private $id;

    #[ORM\Column(type: "integer", name: "post_number")]
    private $postNumber;

    #[ORM\Column(type: "integer", name: "last_post")]
    private $lastPost;

    #[ORM\Column(type: "boolean")]
    private $close;

    #[ORM\OneToMany(targetEntity: "ForumMessage", mappedBy: "forum")]
    #[ORM\JoinColumn(name: "forum_id")]
    private $forumMessages;

    // getters and setters

    /**
     * Get the value of lastModified
     * @return \DateTimeInterface|null
     */ 
    public function getLastModified(): ?\DateTimeInterface
    {
        return $this->lastModified;
    }

    /**
     * Set the value of lastModified
     * @param \DateTimeInterface $lastModified
     * @return self
     */
    public function setLastModified(\DateTimeInterface $lastModified): self
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get the value of id
     * @return string|null
     */ 
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get the value of postNumber
     * @return int|null
     */ 
    public function getPostNumber(): ?int
    {
        return $this->postNumber;
    }

    /**
     * Set the value of postNumber
     * @param int $postNumber
     * @return self
     */
    public function setPostNumber(int $postNumber): self
    {
        $this->postNumber = $postNumber;

        return $this;
    }

    /**
     * Get the value of lastPost
     * @return int|null
     */ 
    public function getLastPost(): ?int
    {
        return $this->lastPost;
    }

    /**
     * Set the value of lastPost
     * @param int $lastPost
     * @return self
     */
    public function setLastPost(int $lastPost): self
    {
        $this->lastPost = $lastPost;

        return $this;
    }

    /**
     * Get the value of close
     * @return bool|null
     */ 
    public function isClose(): ?bool
    {
        return $this->close;
    }

    /**
     * Set the value of close
     * @param bool $close
     * @return self
     */
    public function setClose(bool $close): self
    {
        $this->close = $close;

        return $this;
    }

    /**
     * Get the value of forumMessages
     * @return mixed
     */ 
    public function getForumMessages()
    {
        return $this->forumMessages;
    }

    /**
     * Set the value of forumMessages
     * @param mixed $forumMessages
     * @return self
     */
    public function setForumMessages($forumMessages): self
    {
        $this->forumMessages = $forumMessages;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        $forumMessagesId = [];

        foreach ($this->forumMessages as $forumMessage) {
            $forumMessagesId[] = $forumMessage->getId();
        }

        return [
            'id' => $this->id,
            'lastModified' => $this->lastModified,
            'postNumber' => $this->postNumber,
            'last¨Post' => $this->lastPost,
            'close' => $this->close,
            'forumMessages' => $forumMessagesId,
        ];
    }
}