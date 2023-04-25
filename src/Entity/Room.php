<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=RaspberryPi::class, mappedBy="room")
     */
    private $raspberryPis;

    public function __construct()
    {
        $this->raspberryPis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, RaspberryPi>
     */
    public function getRaspberryPis(): Collection
    {
        return $this->raspberryPis;
    }

    public function addRaspberryPi(RaspberryPi $raspberryPi): self
    {
        if (!$this->raspberryPis->contains($raspberryPi)) {
            $this->raspberryPis[] = $raspberryPi;
            $raspberryPi->setRoom($this);
        }

        return $this;
    }

    public function removeRaspberryPi(RaspberryPi $raspberryPi): self
    {
        if ($this->raspberryPis->removeElement($raspberryPi)) {
            // set the owning side to null (unless already changed)
            if ($raspberryPi->getRoom() === $this) {
                $raspberryPi->setRoom(null);
            }
        }

        return $this;
    }
}
