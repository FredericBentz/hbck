<?php

namespace App\Entity;

use App\Repository\SuspendedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuspendedRepository::class)
 */
class Suspended
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_game;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_suspended;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="suspended_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=MatchHandball::class, inversedBy="suspended_id")
     */
    private $match_id_start;

    /**
     * @ORM\ManyToOne(targetEntity=MatchHandball::class, inversedBy="suspendedId")
     */
    private $match_id_end;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbGame(): ?int
    {
        return $this->nb_game;
    }

    public function setNbGame(int $nb_game): self
    {
        $this->nb_game = $nb_game;

        return $this;
    }

    public function getIsSuspended(): ?bool
    {
        return $this->is_suspended;
    }

    public function setIsSuspended(bool $is_suspended): self
    {
        $this->is_suspended = $is_suspended;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getMatchIdStart(): ?MatchHandball
    {
        return $this->match_id_start;
    }

    public function setMatchIdStart(?MatchHandball $match_id_start): self
    {
        $this->match_id_start = $match_id_start;

        return $this;
    }

    public function getMatchIdEnd(): ?MatchHandball
    {
        return $this->match_id_end;
    }

    public function setMatchIdEnd(?MatchHandball $match_id_end): self
    {
        $this->match_id_end = $match_id_end;

        return $this;
    }
}
