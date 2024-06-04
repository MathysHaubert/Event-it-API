<?php
// src/Entity/Faq.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Faq")]
class Faq implements \JsonSerializable
{
    #[ORM\Column(type: "string", name: "question")]
    private $question;

    #[ORM\Column(type: "string", name: "answer")]
    private $answer;
    // getters and setters

    /**
     * Get the value of question
     * @return string|null
     */
    public function getQuestion(): ?string
    {
        return $this->question;
    }

    /**
     * Set the value of question
     * @param string $question
     */
    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    /**
     * Get the value of answer
     * @return string|null
     */
    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    /**
     * Set the value of answer
     * @param string $answer
     */
    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'question' => $this->question,
            'answer' => $this->answer,
        ];
    }
}
