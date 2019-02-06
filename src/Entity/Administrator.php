<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 27.1.19.
 * Time: 18.30
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;

/**
 * Class Administrator
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\AdministratorRepository")
 */
class Administrator
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sifra;


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
     * @param string $email
     * @return Administrator
     */
    public function setEmail(string $email): ?self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $sifra
     * @return Administrator
     */
    public function setSifra(string $sifra): ?self
    {
        $this->sifra = $sifra;

        return $this;
    }

}