<?php

namespace App\Entity;

use App\Repository\LeagueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LeagueRepository::class)
 */
class League
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=MatchHandball::class, mappedBy="league_id")
     */
    private $matchHandball_id;

    /**
     * @ORM\ManyToOne(targetEntity=Level::class, inversedBy="leagues")
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="leagues")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $id_ffh;

    public function __construct()
    {
        $this->matchHandball_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|MatchHandball[]
     */
    public function getMatchHandballId(): Collection
    {
        return $this->matchHandball_id;
    }

    public function addMatchHandballId(MatchHandball $matchHandballId): self
    {
        if (!$this->matchHandball_id->contains($matchHandballId)) {
            $this->matchHandball_id[] = $matchHandballId;
            $matchHandballId->setLeagueId($this);
        }

        return $this;
    }

    public function removeMatchHandballId(MatchHandball $matchHandballId): self
    {
        if ($this->matchHandball_id->removeElement($matchHandballId)) {
            // set the owning side to null (unless already changed)
            if ($matchHandballId->getLeagueId() === $this) {
                $matchHandballId->setLeagueId(null);
            }
        }

        return $this;
    }


    public function __toString(){   
        return $this->label;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getIdFfh(): ?string
    {
        return $this->id_ffh;
    }

    public function setIdFfh(?string $id_ffh): self
    {
        $this->id_ffh = $id_ffh;

        return $this;
    }
}
