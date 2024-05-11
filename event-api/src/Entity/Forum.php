<?php
// src/Entity/Forum.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Forum")]
class Forum implements \JsonSerializable
{
    #[ORM\Column(type: "datetime")]
    private $last_modified;

    #[ORM\Id]
    #[ORM\Column(type: "string", length: 255)]
    private $id;

    #[ORM\Column(type: "integer")]
    private $post_number;

    #[ORM\Column(type: "integer")]
    private $last_post;

    #[ORM\Column(type: "boolean")]
    private $close;

    #[ORM\OneToMany(targetEntity: "ForumMessage", mappedBy: "forum")]
    private $forum_messages;

    // getters and setters

    /**
     * Get the value of last_modified
     * @return \DateTimeInterface|null
     */ 
    public function getLastModified(): ?\DateTimeInterface
    {
        return $this->last_modified;
    }

    /**
     * Set the value of last_modified
     * @param \DateTimeInterface $last_modified
     * @return self
     */
    public function setLastModified(\DateTimeInterface $last_modified): self
    {
        $this->last_modified = $last_modified;

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
     * Get the value of post_number
     * @return int|null
     */ 
    public function getPostNumber(): ?int
    {
        return $this->post_number;
    }

    /**
     * Set the value of post_number
     * @param int $post_number
     * @return self
     */
    public function setPostNumber(int $post_number): self
    {
        $this->post_number = $post_number;

        return $this;
    }

    /**
     * Get the value of last_post
     * @return int|null
     */ 
    public function getLastPost(): ?int
    {
        return $this->last_post;
    }

    /**
     * Set the value of last_post
     * @param int $last_post
     * @return self
     */
    public function setLastPost(int $last_post): self
    {
        $this->last_post = $last_post;

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
     * Get the value of forum_messages
     * @return mixed
     */ 
    public function getForumMessages()
    {
        return $this->forum_messages;
    }

    /**
     * Set the value of forum_messages
     * @param mixed $forum_messages
     * @return self
     */
    public function setForumMessages($forum_messages): self
    {
        $this->forum_messages = $forum_messages;

        return $this;
    }

    public function jsonSerialize()
    {
        $forumMessagesId = [];

        foreach ($this->forum_messages as $forumMessage) {
            $forumMessagesId[] = $forumMessage->getId();
        }

        return [
            'id' => $this->id,
            'last_modified' => $this->last_modified,
            'post_number' => $this->post_number,
            'last_post' => $this->last_post,
            'close' => $this->close,
            'forum_messages' => $forumMessagesId,
        ];
    }
}