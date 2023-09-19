<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: Formation::class, mappedBy: 'id_user')]
    private Collection $id_formation;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: Note::class)]
    private Collection $id_note;

    public function __construct()
    {
        $this->id_formation = new ArrayCollection();
        $this->id_note = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getIdFormation(): Collection
    {
        return $this->id_formation;
    }

    public function addIdFormation(Formation $idFormation): static
    {
        if (!$this->id_formation->contains($idFormation)) {
            $this->id_formation->add($idFormation);
            $idFormation->addIdUser($this);
        }

        return $this;
    }

    public function removeIdFormation(Formation $idFormation): static
    {
        if ($this->id_formation->removeElement($idFormation)) {
            $idFormation->removeIdUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getIdNote(): Collection
    {
        return $this->id_note;
    }

    public function addIdNote(Note $idNote): static
    {
        if (!$this->id_note->contains($idNote)) {
            $this->id_note->add($idNote);
            $idNote->setIdUser($this);
        }

        return $this;
    }

    public function removeIdNote(Note $idNote): static
    {
        if ($this->id_note->removeElement($idNote)) {
            // set the owning side to null (unless already changed)
            if ($idNote->getIdUser() === $this) {
                $idNote->setIdUser(null);
            }
        }

        return $this;
    }
}
