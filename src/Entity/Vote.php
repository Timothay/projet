<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\activity", inversedBy="votes")
     */
    private $activity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\users", inversedBy="votes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?users
    {
        return $this->user;
    }

    public function setUser(?users $user): self
    {
        $this->user = $user;

        return $this;
    }
}
