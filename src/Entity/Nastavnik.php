<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.01
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Nastavnik
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\NastavnikRepository")
 */
class Nastavnik
{

    /**
     * @ORM\id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prezime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jmbg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sifra;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Predmet", mappedBy="nastavnici")
     */
    private $predmeti;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Odeljenje", inversedBy="nastavnici")
     * @ORM\JoinColumn(nullable=false)
     */
    private $odeljenja;

    public function __construct()
    {
        $this->odeljenja = new ArrayCollection();
        $this->predmeti  = new ArrayCollection();
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
    public function getIme(): ?string
    {
        return $this->ime;
    }

    /**
     * @return string
     */
    public function getPrezime(): ?string
    {
        return $this->prezime;
    }

    /**
     * @return string
     */
    public function getJmbg(): ?string
    {
        return $this->jmbg;
    }

    /**
     * @return string
     */
    public function getAdresa(): ?string
    {
        return $this->adresa;
    }

    /**
     * @return string
     */
    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getSifra(): ?string
    {
        return $this->sifra;
    }

    /**
     * @return Collection|Odeljenje[]
     */
    public function getOdeljenja(): ?Collection
    {
        return $this->odeljenja;
    }

    /**
     * @return Collection|Predmet[]
     */
    public function getPredmeti(): ?Collection
    {
        return $this->predmeti;
    }
    /**
     * @param string $ime
     * @return Nastavnik
     */
    public function setIme(string $ime): ?self
    {
        $this->ime = $ime;

        return $this;
    }

    /**
     * @param string $prezime
     * @return Nastavnik
     */
    public function setPrezime(string $prezime): ?self
    {
        $this->prezime = $prezime;

        return $this;
    }

    /**
     * @param string $jmbg
     * @return Nastavnik
     */
    public function setJmbg(string $jmbg): ?self
    {
        $this->jmbg = $jmbg;

        return $this;
    }

    /**
     * @param string $adresa
     * @return Nastavnik
     */
    public function setAdresa(string $adresa): ?self
    {
        $this->adresa = $adresa;

        return $this;
    }

    /**
     * @param string $telefon
     * @return Nastavnik
     */
    public function setTelefon(string $telefon): ?self
    {
        $this->telefon = $telefon;

        return $this;
    }

    /**
     * @param string $email
     * @return Nastavnik
     */
    public function setEmail(string $email): ?self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $sifa
     * @return Nastavnik
     */
    public function setSifra(string $sifra): ?self
    {
        $this->sifra = $sifra;

        return $this;
    }

    /**
     * @param Odeljenje $odeljenje
     * @return Nastavnik|null
     */
    public function addOdeljenje(Odeljenje $odeljenje): ?self
    {
        if (!$this->odeljenja->contains($odeljenje)) {
            $this->odeljenja[] = $odeljenje;
            $odeljenje->addNastavnik($this);
        }

        return $this;
    }

    /**
     * @param Predmet $predmet
     * @return Nastavnik|null
     */
    public function addPredmet(Predmet $predmet): ?self
    {
        if (!$this->predmeti->contains($predmet)) {
            $this->predmeti[] = $predmet;
            $predmet->addNastavnika($this);
        }

        return $this;
    }

    /**
     * @param Odeljenje $odeljenje
     * @return Nastavnik|null
     */
    public function removeOdeljenje(Odeljenje $odeljenje): ?self
    {
        if ($this->odeljenja->contains($odeljenje)) {
            $this->odeljenja->removeElement($odeljenje);
            if ($odeljenje->getNastavnike()->contains($this)) {
                $odeljenje->removeNastavnika($this);
            }
        }

        return $this;
    }

    /**
     * @param Predmet $predmet
     * @return Nastavnik|null
     */
    public function removePredmet(Predmet $predmet): ?self
    {
        if ($this->predmeti->contains($predmet)) {
            $this->predmeti->removeElement($predmet);
            if ($predmet->getNastavnici()->contains($this)) {
                $predmet->removeNastavnika($this);
            }
        }

        return $this;
    }
}