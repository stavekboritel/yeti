<?php

namespace App\Entity;

use App\Repository\YetiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: YetiRepository::class)]
class Yeti
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type(type: 'integer')]
    private ?int $weight = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type(type: 'integer')]
    private ?int $height = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sex $sex = null;

    #[ORM\OneToMany(mappedBy: 'yeti', targetEntity: YetiVotes::class, orphanRemoval: true)]
    private Collection $yetiVotes;

    public function __construct()
    {
        $this->yetiVotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getSex(): ?Sex
    {
        return $this->sex;
    }

    public function setSex(?Sex $sex): static
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * @return Collection<int, YetiVotes>
     */
    public function getYetiVotes(): Collection
    {
        return $this->yetiVotes;
    }

    public function addYetiVote(YetiVotes $yetiVote): static
    {
        if (!$this->yetiVotes->contains($yetiVote)) {
            $this->yetiVotes->add($yetiVote);
            $yetiVote->setYeti($this);
        }

        return $this;
    }

    public function removeYetiVote(YetiVotes $yetiVote): static
    {
        if ($this->yetiVotes->removeElement($yetiVote)) {
            // set the owning side to null (unless already changed)
            if ($yetiVote->getYeti() === $this) {
                $yetiVote->setYeti(null);
            }
        }

        return $this;
    }

}

