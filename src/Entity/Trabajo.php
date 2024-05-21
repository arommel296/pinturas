<?php

namespace App\Entity;

use App\Repository\TrabajoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrabajoRepository::class)]
class Trabajo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fotos = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\OneToOne(inversedBy: 'trabajo', cascade: ['persist', 'remove'])]
    private ?Factura $factura = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFotos(): ?string
    {
        return $this->fotos;
    }

    public function setFotos(?string $fotos): static
    {
        $this->fotos = $fotos;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFactura(): ?Factura
    {
        return $this->factura;
    }

    public function setFactura(?Factura $factura): static
    {
        $this->factura = $factura;

        return $this;
    }

    public function getServicios() {
        //factura asociada al trabajo
        $factura = $this->getFactura();
    
        //servicios de la factura
        return $factura->getServicios();
    }
}
