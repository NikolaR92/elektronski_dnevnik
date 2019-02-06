<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.25
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Cas
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\CasRepository")
 */
class Cas
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
    private $opis;

    /**
     * @ORM\Column(type="date")
     */
    private $datum;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Odeljenje", inversedBy="casovi")
     * @ORM\JoinColumn(nullable=false)
     */
    private $odeljenje;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ucenik", mappedBy="odustniCasovi")
     */
    private $odsutniUcenici;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Predmet");
     */
    private $predmet;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Nastavnik");
     */
    private $nastavnik;

    public function __construct()
    {
        $this->odsutniUcenici = new ArrayCollection();
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
    public function getOpis(): ?string
    {
        return $this->opis;
    }

    /**
     * @return string
     */
    public function getDatum(): ?string
    {
        return $this->datum;
    }

    /**
     * @return Odeljenje
     */
    public function getOdeljenje(): ?Odeljenje
    {
        return $this->odeljenje;
    }

    /**
     * @return Collection|Ucenik[]
     */
    public function getOdsutniUcenici(): ?Collection
    {
        return $this->odsutniUcenici;
    }

    /**
     * @return Nastavnik
     */
    public function getNastavnik(): ?Nastavnik
    {
        return $this->nastavnik;
    }

    /**
     * @return Predmet
     */
    public function getPredmet(): ?Predmet
    {
        return $this->predmet;
    }

    /**
     * @param string $opis
     * @return Cas
     */
    public function setOpis(string $opis): ?self
    {
        $this->opis = $opis;

        return $this;
    }

    /**
     * @param string $datum
     * @return Cas
     */
    public function setDatum(string $datum): ?self
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * @param Odeljenje $odeljenje
     * @return Cas
     */
    public function setOdeljenje(Odeljenje $odeljenje): ?self
    {
        $this->odeljenje = $odeljenje;

        return $this;
    }

    /**
     * @param Predmet $predmet
     * @return Cas
     */
    public function setPredmet(Predmet $predmet): ?self
    {
        $this->predmet = $predmet;

        return $this;
    }

    /**
     * @param Nastavnik $nastavnik
     * @return Cas
     */
    public function setNastavnik(Nastavnik $nastavnik): ?self
    {
        $this->nastavnik = $nastavnik;

        return $this;
    }

    /**
     * @param Ucenik $ucenik
     * @return Cas|null
     */
    public function addOdsutniUcenici(Ucenik $ucenik): ?self
    {
        if (!$this->odsutniUcenici->contains($ucenik)) {
            $this->odsutniUcenici[] = $ucenik;
            $ucenik->addOdsutniCasovi($this);
        }

        return $this;
    }

    /**
     * @param Ucenik $ucenik
     * @return Cas|null
     */
    public function removeOdsutniUcenici(Ucenik $ucenik): ?self
    {
        if ($this->odsutniUcenici->contains($ucenik)) {
            $this->odsutniUcenici->removeElement($ucenik);
            if ($ucenik->getOdustniCasovi()->contains($this)) {
                $ucenik->removeOdustniCasovi($this);
            }
        }
    }


}