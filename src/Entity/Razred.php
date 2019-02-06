<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.37
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Razred
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\RazredRepository")
 */
class Razred
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $oznaka;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Odeljenje", mappedBy="razred")
     */
    private $odeljenja;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Plan", mappedBy="razred")
     */
    private $plan;

    public function __construct()
    {
        $this->odeljenja = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOznaka(): ?string
    {
        return $this->oznaka;
    }

    /**
     * @return Plan
     */
    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    /**
     * @param string $oznaka
     * @return Razred
     */
    public function setOznaka(string $oznaka): ?self
    {
        $this->oznaka = $oznaka;

        return $this;
    }

    /**
     * @param Plan $plan
     * @return Razred
     */
    public function setPlan(Plan $plan): ?self
    {
        $this->plan = $plan;
        $plan->setRazred($this);
        return $this;
    }

    /**
     * @return Collection|Odeljenje[]
     */
    public function getOdeljenja(): ?Collection
    {
        return $this->odeljenja;
    }

    /**
     * @param Odeljenje $odeljenje
     * @return Razred|null
     */
    public function addOdeljenje(Odeljenje $odeljenje): ?self
    {
        if (!$this->odeljenja->contains($odeljenje)) {
            $this->odeljenja[] = $odeljenje;
            $odeljenje->setRazred($this);
        }

        return $this;
    }

    /**
     * @param Odeljenje $odeljenje
     * @return Razred|null
     */
    public function removeOdeljenje(Odeljenje $odeljenje): ?self
    {
        if ($this->odeljenja->contains($odeljenje)) {
           $this->odeljenja->removeElement($odeljenje);
           if ($odeljenje->getRazred() === $this) {
               $odeljenje->setRazred(null);
           }
        }

        return $this;
    }

}