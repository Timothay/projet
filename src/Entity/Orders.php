<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validated;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ordered_products;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="orders")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Contains", mappedBy="orders")
     */
    private $contains;

    public function __construct()
    {
        $this->contains = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValidated(): ?bool
    {
        return $this->validated;
    }

    public function setValidated(bool $validated): self
    {
        $this->validated = $validated;

        return $this;
    }

    public function getOrderedProducts(): ?string
    {
        return $this->ordered_products;
    }

    public function setOrderedProducts(string $ordered_products): self
    {
        $this->ordered_products = $ordered_products;

        return $this;
    }

    public function getUser(): ?users
    {
        return $this->user;
    }

    public function setUser(?users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Contain[]
     */
    public function getContains(): Collection
    {
        return $this->contains;
    }

    public function addContain(Contain $contain): self
    {
        if (!$this->contains->contains($contain)) {
            $this->contains[] = $contain;
            $contain->addOrder($this);
        }

        return $this;
    }

    public function removeContain(Contain $contain): self
    {
        if ($this->contains->contains($contain)) {
            $this->contains->removeElement($contain);
            $contain->removeOrder($this);
        }

        return $this;
    }
}
