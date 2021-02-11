<?php

namespace App\Entity;

use App\Repository\MatchHandballRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatchHandballRepository::class)
 */
class MatchHandball
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datetime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score_home;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score_away;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="matchHandball_id")
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=Season::class, inversedBy="matchHandball_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $season_id;

    /**
     * @ORM\OneToMany(targetEntity=Suspended::class, mappedBy="match_id_start")
     */
    private $suspended_id;

    /**
     * @ORM\OneToMany(targetEntity=Suspended::class, mappedBy="match_id_end")
     */
    private $suspendedId;

    /**
     * @ORM\ManyToOne(targetEntity=League::class, inversedBy="matchHandball_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $league_id;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_home_id;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_away_id;

    public function __construct()
    {
        $this->user_id = new ArrayCollection();
        $this->suspended_id = new ArrayCollection();
        $this->suspendedId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getScoreHome(): ?int
    {
        return $this->score_home;
    }

    public function setScoreHome(?int $score_home): self
    {
        $this->score_home = $score_home;

        return $this;
    }

    public function getScoreAway(): ?int
    {
        return $this->score_away;
    }

    public function setScoreAway(?int $score_away): self
    {
        $this->score_away = $score_away;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserId(): Collection
    {
        return $this->user_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->user_id->contains($userId)) {
            $this->user_id[] = $userId;
            $userId->addMatchHandballId($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->user_id->removeElement($userId)) {
            $userId->removeMatchHandballId($this);
        }

        return $this;
    }

    public function getSeasonId(): ?Season
    {
        return $this->season_id;
    }

    public function setSeasonId(?Season $season_id): self
    {
        $this->season_id = $season_id;

        return $this;
    }

    /**
     * @return Collection|Suspended[]
     */
    public function getSuspendedId(): Collection
    {
        return $this->suspended_id;
    }

    public function addSuspendedId(Suspended $suspendedId): self
    {
        if (!$this->suspended_id->contains($suspendedId)) {
            $this->suspended_id[] = $suspendedId;
            $suspendedId->setMatchIdStart($this);
        }

        return $this;
    }

    public function removeSuspendedId(Suspended $suspendedId): self
    {
        if ($this->suspended_id->removeElement($suspendedId)) {
            // set the owning side to null (unless already changed)
            if ($suspendedId->getMatchIdStart() === $this) {
                $suspendedId->setMatchIdStart(null);
            }
        }

        return $this;
    }

    public function getLeagueId(): ?League
    {
        return $this->league_id;
    }

    public function setLeagueId(?League $league_id): self
    {
        $this->league_id = $league_id;

        return $this;
    }

    public function getTeamHomeId(): ?Team
    {
        return $this->team_home_id;
    }

    public function setTeamHomeId(?Team $team_home_id): self
    {
        $this->team_home_id = $team_home_id;

        return $this;
    }

    public function getTeamAwayId(): ?Team
    {
        return $this->team_away_id;
    }

    public function setTeamAwayId(?Team $team_away_id): self
    {
        $this->team_away_id = $team_away_id;

        return $this;
    }


}
