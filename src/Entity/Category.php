<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $categoryId;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $categoryName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="categoryParent")
     * @ORM\JoinColumn(name="category_parent_id", referencedColumnName="category_id", onDelete="CASCADE")
     */
    private $categoryParent;

    public function __construct()
    {
    }

    

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }


    public function __toString()
    {
        return $this->categoryName;
    }

    public function getCategoryParent(): ?self
    {
        return $this->categoryParent;
    }

    public function setCategoryParent(?self $categoryParent): self
    {
        $this->categoryParent = $categoryParent;

        return $this;
    }

    public function addCategoryParent(self $categoryParent): self
    {
        if (!$this->categoryParent->contains($categoryParent)) {
            $this->categoryParent[] = $categoryParent;
            $categoryParent->setCategoryParent($this);
        }

        return $this;
    }

    public function removeCategoryParent(self $categoryParent): self
    {
        if ($this->categoryParent->contains($categoryParent)) {
            $this->categoryParent->removeElement($categoryParent);
            // set the owning side to null (unless already changed)
            if ($categoryParent->getCategoryParent() === $this) {
                $categoryParent->setCategoryParent(null);
            }
        }

        return $this;
    }
}
