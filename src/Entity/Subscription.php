<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubscriptionRepository")
 */
class Subscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\users", inversedBy="subscriptions")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\activity", inversedBy="subscriptions")
     */
    private $activity;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getActivity(): ?activity
    {
        return $this->activity;
    }

    public function setActivity(?activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }
}
