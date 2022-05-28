<?php

namespace App\Entity;

use App\Repository\ReportaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReportaRepository::class)
 */
class Reporta
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reportas")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="reportas")
     */
    private $idPost;

    /**
     * @ORM\Column(type="integer")
     */
    private $tipoReport;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdPost(): ?Post
    {
        return $this->idPost;
    }

    public function setIdPost(?Post $idPost): self
    {
        $this->idPost = $idPost;

        return $this;
    }

    public function getTipoReport(): ?int
    {
        return $this->tipoReport;
    }

    public function setTipoReport(int $tipoReport): self
    {
        $this->tipoReport = $tipoReport;

        return $this;
    }
}
