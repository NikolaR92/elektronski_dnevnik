<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.15
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Predmet
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PredmetRepository")
 */
class Predmet
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
    private $naziv;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Plan", inversedBy="predmeti")
     * @ORM\JoinColumn(nullable=false)
     */
    private $planovi;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Nastavnik", inversedBy="predmeti")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nastavnici;

    public function __construct()
    {
        $this->planovi    = new ArrayCollection();
        $this->nastavnici = new ArrayCollection();
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
    public function getNaziv(): ?string
    {
        return $this->naziv;
    }

    /**
     * @return Collection|Plan[]
     */
    public function getPlanovi(): ?Collection
    {
        return $this->planovi;
    }

    /**
     * @return Collection|Nastavnik[]
     */
    public function getNastavnici(): ?Collection
    {
        return $this->nastavnici;
    }

    /**
     * @param string $naziv
     * @return Predmet
     */
    public function setNaziv(string $naziv): ?self
    {
        $this->naziv = $naziv;
        return $this;
    }

    /**
     * @param Plan $plan
     * @return Predmet|null
     */
    public function addPlan(Plan $plan): ?self
    {
        if (!$this->planovi->contains($plan)) {
           $this->planovi[] = $plan;
           $plan->addPredmet($this);
        }

        return $this;
    }

    /**
     * @param Nastavnik $nastavnik
     * @return Predmet|null
     */
    public function addNastavnika(Nastavnik $nastavnik): ?self
    {
        if (!$this->nastavnici->contains($nastavnik)) {
            $this->nastavnici[] = $nastavnik;
            $nastavnik->addPredmet($this);
        }

        return $this;
    }

    /**
     * @param Plan $plan
     * @return Predmet|null
     */
    public function removePlan(Plan $plan): ?self
    {
        if ($this->planovi->contains($plan)) {
            $this->planovi->removeElement($plan);
            if ($plan->getPredmeti()->contains($this)) {
                $plan->removePredmet($this);
            }
        }

        return $this;
    }

    /**
     * @param Nastavnik $nastavnik
     * @return Predmet|null
     */
    public function removeNastavnika(Nastavnik $nastavnik): ?self
    {
        if ($this->nastavnici->contains($nastavnik)) {
            $this->nastavnici->removeElement($nastavnik);
            if ($nastavnik->getPredmeti()->contains($this)) {
                $nastavnik->removePredmet($this);
            }
        }

        return $this;
    }

}