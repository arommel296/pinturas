<?php

namespace App\Entity;

use App\Repository\PresupuestoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresupuestoRepository::class)]
class Presupuesto
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

    #[ORM\ManyToOne(inversedBy: 'presupuestos')]
    private ?Usuario $usuario = null;

    /**
     * @var Collection<int, Servicio>
     */
    #[ORM\ManyToMany(targetEntity: Servicio::class, inversedBy: 'presupuestos')]
    private Collection $servicios;

    #[ORM\OneToOne(mappedBy: 'presupuesto', cascade: ['persist', 'remove'])]
    private ?Factura $factura = null;

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

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

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

    public function getFactura(): ?Factura
    {
        return $this->factura;
    }

    public function setFactura(?Factura $factura): static
    {
        // unset the owning side of the relation if necessary
        if ($factura === null && $this->factura !== null) {
            $this->factura->setPresupuesto(null);
        }

        // set the owning side of the relation if necessary
        if ($factura !== null && $factura->getPresupuesto() !== $this) {
            $factura->setPresupuesto($this);
        }

        $this->factura = $factura;

        return $this;
    }
}
