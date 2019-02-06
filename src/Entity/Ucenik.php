<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 27.1.19.
 * Time: 18.45
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Class Ucenik
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UcenikRepository")
 */
class Ucenik
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
    private $ime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prezime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sifra;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ocena", mappedBy="ucenik")
     */
    private $ocene;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Odeljenje", inversedBy="ucenici")
     * @ORM\JoinColumn(nullable=false)
     */
    private $odeljenje;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cas", inversedBy="odsutniUcenici")
     */
    private $odustniCasovi;

    /**
     * Ucenik constructor.
     */
    public function __construct()
    {
        $this->ocene         = new ArrayCollection();
        $this->odustniCasovi = new ArrayCollection();
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
     * @return Collection|Ocena[]
     */
    public function getOcene(): ?Collection
    {
        return $this->ocene;
    }

    /**
     * @return Odeljenje
     */
    public function getOdeljenje(): ?Odeljenje
    {
        return $this->odeljenje;
    }

    /**
     * @return Collection|Cas[]
     */
    public function getOdustniCasovi(): ?Collection
    {
        return $this->odustniCasovi;
    }

    /**
     * @param string $ime
     * @return Ucenik
     */
    public function setIme($ime): self
    {
        $this->ime = $ime;

        return $this;
    }

    /**
     * @param string $prezime
     * @return Ucenik
     */
    public function setPrezime(string $prezime): ?self
    {
        $this->prezime = $prezime;

        return $this;
    }

    /**
     * @param string $adresa
     * @return Ucenik
     */
    public function setAdresa(string $adresa): ?self
    {
        $this->adresa = $adresa;

        return $this;
    }

    /**
     * @param string $telefon
     * @return Ucenik
     */
    public function setTelefon(string $telefon): ?self
    {
        $this->telefon = $telefon;

        return $this;
    }

    /**
     * @param string $email
     * @return Ucenik
     */
    public function setEmail(string $email): ?self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $sifra
     * @return Ucenik
     */
    public function setSifra(string $sifra): ?self
    {
        $this->sifra = $sifra;

        return $this;
    }

    /**
     * @param string $ocena
     * @return Ucenik
     */
    public function setOcena(string $ocena): ?self
    {
        $this->ocena = $ocena;

        return $this;
    }

    /**
     * @param Odeljenje $odeljenje
     * @return Ucenik
     */
    public function setOdeljenje(Odeljenje $odeljenje): ?self
    {
        $this->odeljenje = $odeljenje;
        return $this;
    }

    /**
     * @param Ocena $ocena
     * @return Ucenik
     */
    public function addOcena(Ocena $ocena): ?self
    {
        if (!$this->ocene->contains($ocena)) {
            $this->ocene[] = $ocena;
            $ocena->setUcenik($this);
        }

        return $this;
    }

    /**
     * @param Cas $cas
     * @return Ucenik|null
     */
    public function addOdsutniCasovi(Cas $cas): ?self
    {
        if (!$this->odustniCasovi->contains($cas)) {
            $this->odustniCasovi[] = $cas;
            $cas->addOdsutniUcenici($this);
        }

        return $this;
    }

    /**
     * @param Ocena $ocena
     * @return Ucenik
     */
    public function removeOcena(Ocena $ocena): ?self
    {

        if ($this->ocene->contains($ocena)) {
            $this->ocene->removeElement($ocena);
            // set the owning side to null (unless already changed)
            if ($ocena->getUcenik() === $this) {
                $ocena->setUcenik(null);
            }
        }

        return $this;
    }

    /**
     * @param Cas $cas
     * @return Ucenik|null
     */
    public function removeOdustniCasovi(Cas $cas): ?self
    {
        if ($this->odustniCasovi->contains($cas)) {
            $this->odustniCasovi->removeElement($cas);
            if ($cas->getOdsutniUcenici()->contains($this)) {
                $cas->removeOdsutniUcenici($this);
            }
        }
    }

}