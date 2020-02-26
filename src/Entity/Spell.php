<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpellRepository")
 */
class Spell
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Race", inversedBy="spells")
     */
    private $race;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Element", inversedBy="spells")
     */
    private $element;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StatsValuePerLvl", mappedBy="spell")
     */
    private $statsValuePerLvls;

    public function __construct()
    {
        $this->race = new ArrayCollection();
        $this->element = new ArrayCollection();
        $this->statsValuePerLvls = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Race[]
     */
    public function getRace(): Collection
    {
        return $this->race;
    }

    public function addRace(Race $race): self
    {
        if (!$this->race->contains($race)) {
            $this->race[] = $race;
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        if ($this->race->contains($race)) {
            $this->race->removeElement($race);
        }

        return $this;
    }

    /**
     * @return Collection|Element[]
     */
    public function getelement(): Collection
    {
        return $this->element;
    }

    public function addElement(Element $element): self
    {
        if (!$this->element->contains($element)) {
            $this->element[] = $element;
            $element->addSpell($this);
        }

        return $this;
    }

    public function removeElement(Element $element): self
    {
        if ($this->element->contains($element)) {
            $this->element->removeElement($element);
            $element->removeSpell($this);
        }

        return $this;
    }

    /**
     * @return Collection|StatsValuePerLvl[]
     */
    public function getStatsValuePerLvls(): Collection
    {
        return $this->statsValuePerLvls;
    }

    public function addStatsValuePerLvl(StatsValuePerLvl $statsValuePerLvl): self
    {
        if (!$this->statsValuePerLvls->contains($statsValuePerLvl)) {
            $this->statsValuePerLvls[] = $statsValuePerLvl;
            $statsValuePerLvl->setSpell($this);
        }

        return $this;
    }

    public function removeStatsValuePerLvl(StatsValuePerLvl $statsValuePerLvl): self
    {
        if ($this->statsValuePerLvls->contains($statsValuePerLvl)) {
            $this->statsValuePerLvls->removeElement($statsValuePerLvl);
            // set the owning side to null (unless already changed)
            if ($statsValuePerLvl->getSpell() === $this) {
                $statsValuePerLvl->setSpell(null);
            }
        }

        return $this;
    }
}
