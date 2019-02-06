<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.29
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Odeljenje
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\OdeljenjeRepository")
 */
class Odeljenje
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $oznaka;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ucenik", mappedBy="odeljenje")
     */
    private $ucenici;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Razredni", inversedBy="odeljenje")
     */
    private $razredni;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cas", mappedBy="odeljenje")
     */
    private $casovi;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Nastavnik", mappedBy="odeljenja")
     */
    private $nastavnici;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Razred", inversedBy="odeljenja")
     * @ORM\JoinColumn(nullable=false)
     */
    private $razred;

    public function __construct()
    {
        $this->ucenici    = new ArrayCollection();
        $this->casovi     = new ArrayCollection();
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
    public function getOznaka(): ?string
    {
        return $this->oznaka;
    }

    /**
     * @return Collection|Ucenik[]
     */
    public function getUcenici(): ?Collection
    {
        return $this->ucenici;
    }

    /**
     * @return Razredni|null
     */
    public function getRazredni(): ?Razredni
    {
        return $this->razredni;
    }

    /**
     * @return Collection|Cas[]
     */
    public function getCasovi(): ?Collection
    {
        return $this->casovi;
    }

    /**
     * @return Collection|Nastavnik[]
     */
    public function getNastavnike(): ?Collection
    {
        return $this->nastavnici;
    }

    /**
     * @return Razred
     */
    public function getRazred(): ?Razred
    {
        return $this->razred;
    }

    /**
     * @param string $oznaka
     * @return Odeljenje
     */
    public function setOznaka(string $oznaka): ?self
    {
        $this->oznaka = $oznaka;

        return $this;
    }

    /**
     * @param Razredni $razredni
     * @return Odeljenje
     */
    public function setRazredni($razredni): ?self
    {
        $this->razredni = $razredni;

        return $this;
    }

    /**
     * @param Razred $razred
     * @return Odeljenje
     */
    public function setRazred(Razred $razred): ?self
    {
        $this->razred = $razred;

        return $this;
    }
    /**
     * @param Ucenik $ucenik
     * @return Odeljenje|null
     */
    public function addUcenik(Ucenik $ucenik): ?self
    {
        if (!$this->ucenici->contains($ucenik)) {
            $this->ucenici[] = $ucenik;
            $ucenik->setOdeljenje($this);
        }

        return $this;
    }

    /**
     * @param Cas $cas
     * @return Odeljenje|null
     */
    public function addCas(Cas $cas): ?self
    {
        if (!$this->casovi->contains($cas)) {
            $this->casovi[] = $cas;
            $cas->setOdeljenje($this);
        }

        return $this;
    }

    /**
     * @param Nastavnik $nastavnik
     * @return Odeljenje|null
     */
    public function addNastavnik(Nastavnik $nastavnik): ?self
    {
        if (!$this->nastavnici->contains($nastavnik)) {
            $this->nastavnici[] = $nastavnik;
            $nastavnik->addOdeljenje($this);
        }

        return $this;
    }

    /**
     * @param Ucenik $ucenik
     * @return Odeljenje|null
     */
    public function removeUcenika(Ucenik $ucenik): ?self
    {
        if (!$this->ucenici->contains($ucenik)) {
            $this->ucenici->removeElement($ucenik);
            if ($ucenik->getOdeljenje() === $this) {
                $ucenik->setOdeljenje(null);
            }
        }

        return $this;
    }

    /**
     * @param Cas $cas
     * @return Odeljenje|null
     */
    public function removeCas(Cas $cas): ?self
    {
        if (!$this->casovi->contains($cas)) {
            $this->casovi->removeElement($cas);
            if ($cas->getOdeljenje() === $this) {
                $cas->setOdeljenje(null);
            }
        }

        return $this;
    }

    /**
     * @param Nastavnik $nastavnik
     * @return Odeljenje|null
     */
    public function removeNastavnika(Nastavnik $nastavnik): ?self
    {
        if (!$this->nastavnici->contains($nastavnik)) {
            $this->nastavnici->removeElement($nastavnik);
            if ($nastavnik->getOdeljenja()->contains($this)) {
                $nastavnik->removeOdeljenje($this);
            }
        }

        return $this;
    }

}