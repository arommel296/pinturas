<?php

namespace App\Entity;

use App\Repository\ServicioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicioRepository::class)]
class Servicio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $icono = null;

    /**
     * @var Collection<int, Presupuesto>
     */
    #[ORM\ManyToMany(targetEntity: Presupuesto::class, mappedBy: 'servicios')]
    private Collection $presupuestos;

    /**
     * @var Collection<int, Factura>
     */
    #[ORM\ManyToMany(targetEntity: Factura::class, mappedBy: 'servicios')]
    private Collection $facturas;

    public function __construct()
    {
        $this->presupuestos = new ArrayCollection();
        $this->facturas = new ArrayCollection();
    }

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getIcono(): ?string
    {
        return $this->icono;
    }

    public function setIcono(string $icono): static
    {
        $this->icono = $icono;

        return $this;
    }

    /**
     * @return Collection<int, Presupuesto>
     */
    public function getPresupuestos(): Collection
    {
        return $this->presupuestos;
    }

    public function addPresupuesto(Presupuesto $presupuesto): static
    {
        if (!$this->presupuestos->contains($presupuesto)) {
            $this->presupuestos->add($presupuesto);
            $presupuesto->addServicio($this);
        }

        return $this;
    }

    public function removePresupuesto(Presupuesto $presupuesto): static
    {
        if ($this->presupuestos->removeElement($presupuesto)) {
            $presupuesto->removeServicio($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Factura>
     */
    public function getFacturas(): Collection
    {
        return $this->facturas;
    }

    public function addFactura(Factura $factura): static
    {
        if (!$this->facturas->contains($factura)) {
            $this->facturas->add($factura);
            $factura->addServicio($this);
        }

        return $this;
    }

    public function removeFactura(Factura $factura): static
    {
        if ($this->facturas->removeElement($factura)) {
            $factura->removeServicio($this);
        }

        return $this;
    }
}
