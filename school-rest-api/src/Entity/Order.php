<?php declare(strict_types=1);


namespace App\Entity;

use App\Repository\OrderRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private Customer $customer;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class)
     */
    private Collection $products;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $ordered_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isPaid = false;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->ordered_at = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function getOrderedAt(): ?DateTimeInterface
    {
        return $this->ordered_at;
    }

    public function setOrderedAt(DateTimeInterface $orderedAt): self
    {
        $this->ordered_at = $orderedAt;

        return $this;
    }

    public function isPaid(): bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getTotalPrice()
    {
        return \DusanKasan\Knapsack\Collection::from($this->getProducts())
            ->reduce(function ($tmpValue, Product $product) {
                return $tmpValue + $product->getPrice();
            }, 0);
    }
}
