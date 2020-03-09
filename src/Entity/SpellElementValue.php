<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpellElementValueRepository")
 */
class SpellElementValue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $valueMin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $valueMax;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Element", mappedBy="value")
     */
    private $elements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Spell", mappedBy="value")
     */
    private $spells;

    public function __construct()
    {
        $this->elements = new ArrayCollection();
        $this->spells = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValueMin(): ?int
    {
        return $this->valueMin;
    }

    public function setValueMin(?int $valueMin): self
    {
        $this->valueMin = $valueMin;

        return $this;
    }

    public function getValueMax(): ?int
    {
        return $this->valueMax;
    }

    public function setValueMax(?int $valueMax): self
    {
        $this->valueMax = $valueMax;

        return $this;
    }

    /**
     * @return Collection|Element[]
     */
    public function getElements(): Collection
    {
        return $this->elements;
    }

    public function addElement(Element $element): self
    {
        if (!$this->elements->contains($element)) {
            $this->elements[] = $element;
            $element->setValue($this);
        }

        return $this;
    }

    public function removeElement(Element $element): self
    {
        if ($this->elements->contains($element)) {
            $this->elements->removeElement($element);
            // set the owning side to null (unless already changed)
            if ($element->getValue() === $this) {
                $element->setValue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Spell[]
     */
    public function getSpells(): Collection
    {
        return $this->spells;
    }

    public function addSpell(Spell $spell): self
    {
        if (!$this->spells->contains($spell)) {
            $this->spells[] = $spell;
            $spell->setValue($this);
        }

        return $this;
    }

    public function removeSpell(Spell $spell): self
    {
        if ($this->spells->contains($spell)) {
            $this->spells->removeElement($spell);
            // set the owning side to null (unless already changed)
            if ($spell->getValue() === $this) {
                $spell->setValue(null);
            }
        }

        return $this;
    }
}
