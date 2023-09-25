<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'id_category')]
    private Collection $id_article;

    #[ORM\ManyToMany(targetEntity: Formation::class, mappedBy: 'id_category')]
    private Collection $id_formation;

    public function __construct()
    {
        $this->id_article = new ArrayCollection();
        $this->id_formation = new ArrayCollection();
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

    /**
     * @return Collection<int, Article>
     */
    public function getIdArticle(): Collection
    {
        return $this->id_article;
    }

    public function addIdArticle(Article $idArticle): static
    {
        if (!$this->id_article->contains($idArticle)) {
            $this->id_article->add($idArticle);
        }

        return $this;
    }

    public function removeIdArticle(Article $idArticle): static
    {
        $this->id_article->removeElement($idArticle);

        return $this;
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
        }

        return $this;
    }

    public function removeIdFormation(Formation $idFormation): static
    {
        $this->id_formation->removeElement($idFormation);

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
