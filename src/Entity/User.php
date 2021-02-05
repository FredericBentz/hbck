<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, \Serializable
{ 
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, inversedBy="user_id")
     */
    private $role_id;

    /**
     * @ORM\ManyToMany(targetEntity=MatchHandball::class, inversedBy="user_id")
     */
    private $matchHandball_id;

    /**
     * @ORM\OneToMany(targetEntity=Injury::class, mappedBy="user_id", orphanRemoval=true)
     */
    private $injury_id;

    /**
     * @ORM\OneToMany(targetEntity=Suspended::class, mappedBy="user_id", orphanRemoval=true)
     */
    private $suspended_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function __construct()
    {
        $this->role_id = new ArrayCollection();
        $this->matchHandball_id = new ArrayCollection();
        $this->injury_id = new ArrayCollection();
        $this->suspended_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRoleId(): Collection
    {
        return $this->role_id;
    }

    public function addRoleId(Role $roleId): self
    {
        if (!$this->role_id->contains($roleId)) {
            $this->role_id[] = $roleId;
        }

        return $this;
    }

    public function removeRoleId(Role $roleId): self
    {
        $this->role_id->removeElement($roleId);

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
        }

        return $this;
    }

    public function removeMatchHandballId(MatchHandball $matchHandballId): self
    {
        $this->matchHandball_id->removeElement($matchHandballId);

        return $this;
    }

    /**
     * @return Collection|Injury[]
     */
    public function getInjuryId(): Collection
    {
        return $this->injury_id;
    }

    public function addInjuryId(Injury $injuryId): self
    {
        if (!$this->injury_id->contains($injuryId)) {
            $this->injury_id[] = $injuryId;
            $injuryId->setUserId($this);
        }

        return $this;
    }

    public function removeInjuryId(Injury $injuryId): self
    {
        if ($this->injury_id->removeElement($injuryId)) {
            // set the owning side to null (unless already changed)
            if ($injuryId->getUserId() === $this) {
                $injuryId->setUserId(null);
            }
        }

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
            $suspendedId->setUserId($this);
        }

        return $this;
    }

    public function removeSuspendedId(Suspended $suspendedId): self
    {
        if ($this->suspended_id->removeElement($suspendedId)) {
            // set the owning side to null (unless already changed)
            if ($suspendedId->getUserId() === $this) {
                $suspendedId->setUserId(null);
            }
        }

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
