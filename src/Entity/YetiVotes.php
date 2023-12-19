<?php

namespace App\Entity;

use App\Repository\YetiVotesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: YetiVotesRepository::class)]
class YetiVotes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'yetiVotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Yeti $yeti = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $vote = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYeti(): ?Yeti
    {
        return $this->yeti;
    }

    public function setYeti(?Yeti $yeti): static
    {
        $this->yeti = $yeti;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getVote(): ?int
    {
        return $this->vote;
    }

    public function setVote(int $vote): static
    {
        $this->vote = $vote;

        return $this;
    }
}
