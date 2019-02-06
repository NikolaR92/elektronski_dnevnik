<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.21
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Ocena
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\OcenaRepository")
 */
class Ocena
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datum;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ucenik", inversedBy="ocene")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ucenik;

    /**
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Nastavnik")
     */
    private $nastavnik;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Predmet")
     */
    private $predmet;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\Column(type="string")
     */
    private $gradivo;


    public function __construct()
    {
        $this->nastavnik = new ArrayCollection();
        $this->predmet = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getGradivo()
    {
        return $this->gradivo;
    }
    /**
     * @return \DateTime
     */
    public function getDatum(): ?string
    {
        return $this->datum;
    }

    /**
     * @return Ucenik
     */
    public function getUcenik(): ?Ucenik
    {
        return $this->ucenik;
    }

    /**
     * @return Nastavnik
     */
    public function getNastavnik(): ?Nastavnik
    {
        return $this->nastavnik->first();
    }

    /**
     * @return Predmet
     */
    public function getPredmet(): ?Predmet
    {
        return $this->predmet->first();
    }


    /**
     * @param \DateTime $datum
     * @return Ocena
     */
    public function setDatum(\DateTime $datum): ?self
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * @param integer $value
     */
    public function setValue(int $value): ?self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $gradivo
     * @return Ocena
     */
    public function setGradivo(string $gradivo): ?self
    {
        $this->gradivo = $gradivo;
        return $this;
    }

    /**
     * @param Ucenik $ucenik
     * @return Ocena
     */
    public function setUcenik(Ucenik $ucenik): ?self
    {
        $this->ucenik = $ucenik;

        return $this;
    }

    /**
     * @param Predmet $predmet
     * @return Ocena
     */
    public function setPredmet(Predmet $predmet): ?self
    {
        $this->predmet = $predmet;

        return $this;
    }

    /**
     * @param Nastavnik $nastavnik
     * @return Ocena
     */
    public function setNastavnik(Nastavnik $nastavnik): ?self
    {
        $this->nastavnik = $nastavnik;

        return $this;
    }

    public function addNastavnik(Nastavnik $nastavnik): self
    {
        if (!$this->nastavnik->contains($nastavnik)) {
            $this->nastavnik[]=$nastavnik;
        }
        return $this;
    }
    public function addPRedmet(Predmet $predmet): self
    {
        if (!$this->predmet->contains($predmet)) {
            $this->predmet[]=$predmet;
        }
        return $this;
    }
}