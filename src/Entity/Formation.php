<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $media_filename = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'id_formation')]
    private Collection $id_category;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'id_formation')]
    private Collection $id_user;

    #[ORM\OneToMany(mappedBy: 'id_formation', targetEntity: Note::class)]
    private Collection $id_note;

    public function __construct()
    {
        $this->id_category = new ArrayCollection();
        $this->id_user = new ArrayCollection();
        $this->id_note = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getMediaFilename(): ?string
    {
        return $this->media_filename;
    }

    public function setMediaFilename(?string $media_filename): static
    {
        $this->media_filename = $media_filename;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getIdCategory(): Collection
    {
        return $this->id_category;
    }

    public function addIdCategory(Category $idCategory): static
    {
        if (!$this->id_category->contains($idCategory)) {
            $this->id_category->add($idCategory);
            $idCategory->addIdFormation($this);
        }

        return $this;
    }

    public function removeIdCategory(Category $idCategory): static
    {
        if ($this->id_category->removeElement($idCategory)) {
            $idCategory->removeIdFormation($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getIdUser(): Collection
    {
        return $this->id_user;
    }

    public function addIdUser(User $idUser): static
    {
        if (!$this->id_user->contains($idUser)) {
            $this->id_user->add($idUser);
        }

        return $this;
    }

    public function removeIdUser(User $idUser): static
    {
        $this->id_user->removeElement($idUser);

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
            $idNote->setIdFormation($this);
        }

        return $this;
    }

    public function removeIdNote(Note $idNote): static
    {
        if ($this->id_note->removeElement($idNote)) {
            // set the owning side to null (unless already changed)
            if ($idNote->getIdFormation() === $this) {
                $idNote->setIdFormation(null);
            }
        }

        return $this;
    }
}
