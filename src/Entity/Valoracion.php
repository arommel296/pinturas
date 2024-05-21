<?php

namespace App\Entity;

use App\Repository\ValoracionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ValoracionRepository::class)]
class Valoracion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comentario = null;

    #[ORM\Column]
    private ?int $nota = null;

    #[ORM\Column(length: 100)]
    private ?string $titulo = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $fotos = null;

    #[ORM\ManyToOne(inversedBy: 'valoraciones')]
    private ?Usuario $usuario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(?string $comentario): static
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getNota(): ?int
    {
        return $this->nota;
    }

    public function setNota(int $nota): static
    {
        $this->nota = $nota;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getFotos(): ?array
    {
        return $this->fotos;
    }

    public function setFotos(?array $fotos): static
    {
        $this->fotos = $fotos;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }
}
