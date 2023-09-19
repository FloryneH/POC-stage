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

    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'id_category')]
    private Collection $id_article;

    #[ORM\ManyToMany(targetEntity: Formation::class, inversedBy: 'id_category')]
    private Collection $id_formaion;

    public function __construct()
    {
        $this->id_article = new ArrayCollection();
        $this->id_formaion = new ArrayCollection();
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
    public function getIdFormaion(): Collection
    {
        return $this->id_formaion;
    }

    public function addIdFormaion(Formation $idFormaion): static
    {
        if (!$this->id_formaion->contains($idFormaion)) {
            $this->id_formaion->add($idFormaion);
        }

        return $this;
    }

    public function removeIdFormaion(Formation $idFormaion): static
    {
        $this->id_formaion->removeElement($idFormaion);

        return $this;
    }
}
