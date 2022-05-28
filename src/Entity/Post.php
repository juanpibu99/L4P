<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenido;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $foto;

    /**
     * @ORM\Column(type="boolean")
     */
    private $respuesta;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idRespuesta;

    /**
     * @ORM\ManyToOne(targetEntity=Juego::class, inversedBy="posts")
     */
    private $idJuego;

    /**
     * @ORM\OneToMany(targetEntity=Gusta::class, mappedBy="idPost")
     */
    private $gustas;

    /**
     * @ORM\OneToMany(targetEntity=Reporta::class, mappedBy="idPost")
     */
    private $reportas;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     */
    private $idUser;

    public function __construct()
    {
        $this->gustas = new ArrayCollection();
        $this->reportas = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): self
    {
        $this->contenido = $contenido;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function isRespuesta(): ?bool
    {
        return $this->respuesta;
    }

    public function setRespuesta(bool $respuesta): self
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    public function getIdRespuesta(): ?int
    {
        return $this->idRespuesta;
    }

    public function setIdRespuesta(?int $idRespuesta): self
    {
        $this->idRespuesta = $idRespuesta;

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

    /**
     * @return Collection<int, Gusta>
     */
    public function getGustas(): Collection
    {
        return $this->gustas;
    }

    public function addGusta(Gusta $gusta): self
    {
        if (!$this->gustas->contains($gusta)) {
            $this->gustas[] = $gusta;
            $gusta->setIdPost($this);
        }

        return $this;
    }

    public function removeGusta(Gusta $gusta): self
    {
        if ($this->gustas->removeElement($gusta)) {
            // set the owning side to null (unless already changed)
            if ($gusta->getIdPost() === $this) {
                $gusta->setIdPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reporta>
     */
    public function getReportas(): Collection
    {
        return $this->reportas;
    }

    public function addReporta(Reporta $reporta): self
    {
        if (!$this->reportas->contains($reporta)) {
            $this->reportas[] = $reporta;
            $reporta->setIdPost($this);
        }

        return $this;
    }

    public function removeReporta(Reporta $reporta): self
    {
        if ($this->reportas->removeElement($reporta)) {
            // set the owning side to null (unless already changed)
            if ($reporta->getIdPost() === $this) {
                $reporta->setIdPost(null);
            }
        }

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

  


  
}
