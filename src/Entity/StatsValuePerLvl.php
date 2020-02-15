<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatsValuePerLvlRepository")
 */
class StatsValuePerLvl
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Attribut", inversedBy="statsValuePerLvl", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $attribut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Spell", inversedBy="statsValuePerLvls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $spell;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getAttribut(): ?Attribut
    {
        return $this->attribut;
    }

    public function setAttribut(Attribut $attribut): self
    {
        $this->attribut = $attribut;

        return $this;
    }

    public function getSpell(): ?Spell
    {
        return $this->spell;
    }

    public function setSpell(?Spell $spell): self
    {
        $this->spell = $spell;

        return $this;
    }
}
