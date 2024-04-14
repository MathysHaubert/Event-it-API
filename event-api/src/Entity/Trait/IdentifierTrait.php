<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait IdentifierTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }
}