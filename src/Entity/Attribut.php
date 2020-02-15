<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributRepository")
 */
class Attribut
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
     * @ORM\OneToOne(targetEntity="App\Entity\StatsValuePerLvl", mappedBy="attribut", cascade={"persist", "remove"})
     */
    private $statsValuePerLvl;

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

    public function getStatsValuePerLvl(): ?StatsValuePerLvl
    {
        return $this->statsValuePerLvl;
    }

    public function setStatsValuePerLvl(StatsValuePerLvl $statsValuePerLvl): self
    {
        $this->statsValuePerLvl = $statsValuePerLvl;

        // set the owning side of the relation if necessary
        if ($statsValuePerLvl->getAttribut() !== $this) {
            $statsValuePerLvl->setAttribut($this);
        }

        return $this;
    }
}
