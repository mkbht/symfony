<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $productId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $productDescription;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     * @ORM\JoinTable(name="product_category",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="product_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="category_id")}
     *      )
     */
    private $productCategory;

    public function __construct()
    {
        $this->productCategory = new ArrayCollection();
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->productDescription;
    }

    public function setProductDescription(?string $productDescription): self
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getProductCategory(): Collection
    {
        return $this->productCategory;
    }

    public function addProductCategory(Category $productCategory): self
    {
        if (!$this->productCategory->contains($productCategory)) {
            $this->productCategory[] = $productCategory;
        }

        return $this;
    }

    public function removeProductCategory(Category $productCategory): self
    {
        if ($this->productCategory->contains($productCategory)) {
            $this->productCategory->removeElement($productCategory);
        }

        return $this;
    }
}
