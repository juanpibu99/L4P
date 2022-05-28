<?php

namespace App\Entity;

use App\Repository\JuegoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JuegoRepository::class)
 */
class Juego
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="blob")
     */
    private $foto;

    private $rawPhoto;

    public function displayPhoto()
    {
        if(null === $this->rawPhoto) {
            $this->rawPhoto = "data:image/png;base64," . base64_encode(stream_get_contents($this->getFoto()));
        }

        return $this->rawPhoto;
    }


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $categoria;

    /**
     * @ORM\OneToMany(targetEntity=Juega::class, mappedBy="idJuego")
     */
    private $juegas;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="idJuego")
     */
    private $posts;

    public function __construct()
    {
        $this->juegas = new ArrayCollection();
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * @return Collection<int, Juega>
     */
    public function getJuegas(): Collection
    {
        return $this->juegas;
    }

    public function addJuega(Juega $juega): self
    {
        if (!$this->juegas->contains($juega)) {
            $this->juegas[] = $juega;
            $juega->setIdJuego($this);
        }

        return $this;
    }

    public function removeJuega(Juega $juega): self
    {
        if ($this->juegas->removeElement($juega)) {
            // set the owning side to null (unless already changed)
            if ($juega->getIdJuego() === $this) {
                $juega->setIdJuego(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setIdJuego($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getIdJuego() === $this) {
                $post->setIdJuego(null);
            }
        }

        return $this;
    }
}
