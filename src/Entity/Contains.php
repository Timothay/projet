<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContainsRepository")
 */
class Contains
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\orders", inversedBy="contains")
     */
    private $orders;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Products", inversedBy="contains")
     */
    private $products;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|orders[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
        }

        return $this;
    }

    public function removeOrder(orders $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
        }

        return $this;
    }

    /**
     * @return Collection|products[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(products $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
        }

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }
}
