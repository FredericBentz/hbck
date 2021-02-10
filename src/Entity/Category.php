<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="category_id")
     */
    private $team_id;

    /**
     * @ORM\OneToMany(targetEntity=League::class, mappedBy="category")
     */
    private $leagues;

    public function __construct()
    {
        $this->team_id = new ArrayCollection();
        $this->leagues = new ArrayCollection();
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
     * @return Collection|Team[]
     */
    public function getTeamId(): Collection
    {
        return $this->team_id;
    }

    public function addTeamId(Team $teamId): self
    {
        if (!$this->team_id->contains($teamId)) {
            $this->team_id[] = $teamId;
            $teamId->setCategoryId($this);
        }

        return $this;
    }

    public function removeTeamId(Team $teamId): self
    {
        if ($this->team_id->removeElement($teamId)) {
            // set the owning side to null (unless already changed)
            if ($teamId->getCategoryId() === $this) {
                $teamId->setCategoryId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|League[]
     */
    public function getLeagues(): Collection
    {
        return $this->leagues;
    }

    public function addLeague(League $league): self
    {
        if (!$this->leagues->contains($league)) {
            $this->leagues[] = $league;
            $league->setCategory($this);
        }

        return $this;
    }

    public function removeLeague(League $league): self
    {
        if ($this->leagues->removeElement($league)) {
            // set the owning side to null (unless already changed)
            if ($league->getCategory() === $this) {
                $league->setCategory(null);
            }
        }

        return $this;
    }
}
