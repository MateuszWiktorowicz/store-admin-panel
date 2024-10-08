<?php

namespace App\Entity;

use App\Repository\AssignedDiscountRepository;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->orderItems = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /**
     * @var Collection<int, OrderItem>
     */
    #[ORM\OneToMany(targetEntity: OrderItem::class, mappedBy: 'purchase', cascade: ['persist', 'remove'], orphanRemoval: true, fetch: 'EAGER')]
    #[Assert\NotBlank()]
    private Collection $orderItems;

    #[ORM\Column]
    private ?float $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setPurchase($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {

            if ($orderItem->getPurchase() === $this) {
                $orderItem->setPurchase(null);
            }
        }

        return $this;
    }


    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(): static
    {
        $discountValue = 0;
        $total = 0;

        foreach ($this->getOrderItems() as $orderItem) {


            $price = $orderItem->getProduct()->getPrice();
            $quantity = $orderItem->getQuantity();

            $discount = $orderItem->getProduct()->getDiscount();
            if ($discount) {
                $assignedDiscount = $orderItem->getPurchase()->getUser()->getAssignedDiscountValue($discount);

                $discountValue =  $assignedDiscount ? $assignedDiscount->getValue() : 0;
            }

            $total += $price * (100 - $discountValue) / 100 * $quantity;
        }


        $this->value = $total;

        return $this;
    }

    public function stockUpdate(OrderItem $orderItem, $editedAmount = 0, $isDelete = false): static
    {
        $currentStock = $orderItem->getProduct()->getStock();

        $currentStock += $editedAmount;

        if (!$isDelete) {
            $amount = $orderItem->getQuantity();
            $currentStock -= $amount;
        }

        $orderItem->getProduct()->setStock($currentStock);

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
}
