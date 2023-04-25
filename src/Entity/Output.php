<?php

namespace App\Entity;

use App\Repository\OutputRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OutputRepository::class)
 */
class Output
{
    /**
     * @Groups({"api_output"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"api_output"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"api_output"})
     * @ORM\Column(type="integer")
     */
    private $gpio;

    /**
     * @Groups({"api_output"})
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity=RaspberryPi::class, inversedBy="outputs")
     */
    private $raspberryPi;

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

    public function getGpio(): ?int
    {
        return $this->gpio;
    }

    public function setGpio(int $gpio): self
    {
        $this->gpio = $gpio;

        return $this;
    }

    public function getState(): ?bool
    {
        return $this->state;
    }

    public function setState(?bool $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getRaspberryPi(): ?RaspberryPi
    {
        return $this->raspberryPi;
    }

    public function setRaspberryPi(?RaspberryPi $raspberryPi): self
    {
        $this->raspberryPi = $raspberryPi;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
