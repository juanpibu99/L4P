<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verificado;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $foto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ubicacion;

    /**
     * @ORM\OneToMany(targetEntity=Juega::class, mappedBy="usernameUser")
     */
    private $juegas;

    /**
     * @ORM\OneToMany(targetEntity=Gusta::class, mappedBy="idUser")
     */
    private $gustas;

    /**
     * @ORM\OneToMany(targetEntity=Reporta::class, mappedBy="idUser")
     */
    private $reportas;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="idUser")
     */
    private $posts;

    public function __construct()
    {
        $this->juegas = new ArrayCollection();
        $this->gustas = new ArrayCollection();
        $this->reportas = new ArrayCollection();
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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

    public function isVerificado(): ?bool
    {
        return $this->verificado;
    }

    public function setVerificado(bool $verificado): self
    {
        $this->verificado = $verificado;

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

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUbicacion(): ?string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(?string $ubicacion): self
    {
        $this->ubicacion = $ubicacion;

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
            $juega->setUsernameUser($this);
        }

        return $this;
    }

    public function removeJuega(Juega $juega): self
    {
        if ($this->juegas->removeElement($juega)) {
            // set the owning side to null (unless already changed)
            if ($juega->getUsernameUser() === $this) {
                $juega->setUsernameUser(null);
            }
        }

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
            $gusta->setIdUser($this);
        }

        return $this;
    }

    public function removeGusta(Gusta $gusta): self
    {
        if ($this->gustas->removeElement($gusta)) {
            // set the owning side to null (unless already changed)
            if ($gusta->getIdUser() === $this) {
                $gusta->setIdUser(null);
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
            $reporta->setIdUser($this);
        }

        return $this;
    }

    public function removeReporta(Reporta $reporta): self
    {
        if ($this->reportas->removeElement($reporta)) {
            // set the owning side to null (unless already changed)
            if ($reporta->getIdUser() === $this) {
                $reporta->setIdUser(null);
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
            $post->setIdUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getIdUser() === $this) {
                $post->setIdUser(null);
            }
        }

        return $this;
    }
}
