<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $featured_text = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $media_filename = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'id_article')]
    private Collection $id_category;

    #[ORM\OneToMany(mappedBy: 'id_article', targetEntity: Commentaire::class, orphanRemoval: true)]
    private Collection $id_commentaires;

    public function __construct()
    {
        $this->id_category = new ArrayCollection();
        $this->id_commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

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

    public function getFeaturedText(): ?string
    {
        return $this->featured_text;
    }

    public function setFeaturedText(?string $featured_text): static
    {
        $this->featured_text = $featured_text;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

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
            $idCategory->addIdArticle($this);
        }

        return $this;
    }

    public function removeIdCategory(Category $idCategory): static
    {
        if ($this->id_category->removeElement($idCategory)) {
            $idCategory->removeIdArticle($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getIdCommentaires(): Collection
    {
        return $this->id_commentaires;
    }

    public function addIdCommentaire(Commentaire $idCommentaire): static
    {
        if (!$this->id_commentaires->contains($idCommentaire)) {
            $this->id_commentaires->add($idCommentaire);
            $idCommentaire->setIdArticle($this);
        }

        return $this;
    }

    public function removeIdCommentaire(Commentaire $idCommentaire): static
    {
        if ($this->id_commentaires->removeElement($idCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($idCommentaire->getIdArticle() === $this) {
                $idCommentaire->setIdArticle(null);
            }
        }

        return $this;
    }
}
