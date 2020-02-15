<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ElementRepository")
 */
class Element
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Spell", inversedBy="elements")
     */
    private $spell;

    public function __construct()
    {
        $this->spell = new ArrayCollection();
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

    /**
     * @return Collection|Spell[]
     */
    public function getSpell(): Collection
    {
        return $this->spell;
    }

    public function addSpell(Spell $spell): self
    {
        if (!$this->spell->contains($spell)) {
            $this->spell[] = $spell;
        }

        return $this;
    }

    public function removeSpell(Spell $spell): self
    {
        if ($this->spell->contains($spell)) {
            $this->spell->removeElement($spell);
        }

        return $this;
    }
}
