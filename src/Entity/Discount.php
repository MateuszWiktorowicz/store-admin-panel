<?php

namespace App\Entity;

use App\Repository\DiscountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiscountRepository::class)]
class Discount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'discount')]
    private Collection $products;

    /**
     * @var Collection<int, AssignedDiscount>
     */
    #[ORM\OneToMany(targetEntity: AssignedDiscount::class, mappedBy: 'discount', orphanRemoval: true)]
    private Collection $assignedDiscounts;


    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->assignedDiscounts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setDiscount($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getDiscount() === $this) {
                $product->setDiscount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AssignedDiscount>
     */
    public function getAssignedDiscounts(): Collection
    {
        return $this->assignedDiscounts;
    }

    public function addAssignedDiscount(AssignedDiscount $assignedDiscount): static
    {
        if (!$this->assignedDiscounts->contains($assignedDiscount)) {
            $this->assignedDiscounts->add($assignedDiscount);
            $assignedDiscount->setDiscount($this);
        }

        return $this;
    }

    public function removeAssignedDiscount(AssignedDiscount $assignedDiscount): static
    {
        if ($this->assignedDiscounts->removeElement($assignedDiscount)) {
            // set the owning side to null (unless already changed)
            if ($assignedDiscount->getDiscount() === $this) {
                $assignedDiscount->setDiscount(null);
            }
        }

        return $this;
    }
}
