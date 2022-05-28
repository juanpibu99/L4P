<?php

namespace App\Entity;

use App\Repository\JuegaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JuegaRepository::class)
 */
class Juega
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="juegas")
     */
    private $usernameUser;

    /**
     * @ORM\ManyToOne(targetEntity=Juego::class, inversedBy="juegas")
     */
    private $idJuego;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsernameUser(): ?User
    {
        return $this->usernameUser;
    }

    public function setUsernameUser(?User $usernameUser): self
    {
        $this->usernameUser = $usernameUser;

        return $this;
    }

    public function getIdJuego(): ?Juego
    {
        return $this->idJuego;
    }

    public function setIdJuego(?Juego $idJuego): self
    {
        $this->idJuego = $idJuego;

        return $this;
    }
}
