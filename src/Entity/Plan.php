<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 28.1.19.
 * Time: 21.41
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Plan
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PlanRespository")
 */
class Plan
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Razred", inversedBy="plan")
     */
    private $razred;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Predmet", mappedBy="planovi")
     * @ORM\JoinColumn(nullable=false)
     */
    private $predmeti;

    public function __construct()
    {
        $this->predmeti = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Razred
     */
    public function getRazred(): ?Razred
    {
        return $this->razred;
    }

    /**
     * @return Collection|Predmet[]
     */
    public function getPredmeti(): ?Collection
    {
        return $this->predmeti;
    }

    /**
     * @param Razred $razred
     * @return Plan
     */
    public function setRazred(Razred $razred): ?Plan
    {
        $this->razred = $razred;

        return $this;
    }

    /**
     * @param Predmet $predmet
     * @return Plan|null
     */
    public function addPredmet(Predmet $predmet): ?self
    {
        if (!$this->predmeti->contains($predmet)) {
            $this->predmeti[] = $predmet;
            $predmet->addPlan($this);
        }

        return $this;
    }

    /**
     * @param Predmet $predmet
     * @return Plan|null
     */
    public function removePredmet(Predmet $predmet): ?self
    {
        if ($this->predmeti->contains($predmet)) {
            $this->predmeti->removeElement($predmet);
            if ($predmet->getPlanovi()->contains($this)) {
                $predmet->removePlan($this);
            }
        }

        return $this;
    }

}