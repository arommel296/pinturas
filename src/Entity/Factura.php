<?php

namespace App\Entity;

use App\Repository\FacturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FacturaRepository::class)]
class Factura
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenido = null;

    #[ORM\Column]
    private ?bool $enviado = null;

    /**
     * @var Collection<int, Servicio>
     */
    #[ORM\ManyToMany(targetEntity: Servicio::class, inversedBy: 'facturas')]
    private Collection $servicios;

    #[ORM\ManyToOne(inversedBy: 'facturas')]
    private ?Usuario $usuario = null;

    #[ORM\OneToOne(inversedBy: 'factura', cascade: ['persist', 'remove'])]
    private ?Presupuesto $presupuesto = null;

    #[ORM\OneToOne(mappedBy: 'factura', cascade: ['persist', 'remove'])]
    private ?Trabajo $trabajo = null;

    // #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    // private ?Presupuesto $presupuesto = null;

    public function __construct()
    {
        $this->servicios = new ArrayCollection();
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

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): static
    {
        $this->contenido = $contenido;

        return $this;
    }

    public function isEnviado(): ?bool
    {
        return $this->enviado;
    }

    public function setEnviado(bool $enviado): static
    {
        $this->enviado = $enviado;

        return $this;
    }

    /**
     * @return Collection<int, Servicio>
     */
    public function getServicios(): Collection
    {
        return $this->servicios;
    }

    public function addServicio(Servicio $servicio): static
    {
        if (!$this->servicios->contains($servicio)) {
            $this->servicios->add($servicio);
        }

        return $this;
    }

    public function removeServicio(Servicio $servicio): static
    {
        $this->servicios->removeElement($servicio);

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

    // public function getPresupuesto(): ?Presupuesto
    // {
    //     return $this->presupuesto;
    // }

    // public function setPresupuesto(?Presupuesto $presupuesto): static
    // {
    //     $this->presupuesto = $presupuesto;

    //     return $this;
    // }

    public function getPresupuesto(): ?Presupuesto
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(?Presupuesto $presupuesto): static
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    public function getTrabajo(): ?Trabajo
    {
        return $this->trabajo;
    }

    public function setTrabajo(?Trabajo $trabajo): static
    {
        // unset the owning side of the relation if necessary
        if ($trabajo === null && $this->trabajo !== null) {
            $this->trabajo->setFactura(null);
        }

        // set the owning side of the relation if necessary
        if ($trabajo !== null && $trabajo->getFactura() !== $this) {
            $trabajo->setFactura($this);
        }

        $this->trabajo = $trabajo;

        return $this;
    }
}
