<?php

namespace App\Entity;

use App\Repository\ProvinciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProvinciaRepository::class)]
class Provincia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 6)]
    private ?string $codigo = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Localidad>
     */
    #[ORM\OneToMany(targetEntity: Localidad::class, mappedBy: 'provincia')]
    private Collection $localidades;

    public function __construct()
    {
        $this->localidades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
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

    /**
     * @return Collection<int, Localidad>
     */
    public function getLocalidades(): Collection
    {
        return $this->localidades;
    }

    public function addLocalidade(Localidad $localidade): static
    {
        if (!$this->localidades->contains($localidade)) {
            $this->localidades->add($localidade);
            $localidade->setProvincia($this);
        }

        return $this;
    }

    public function removeLocalidade(Localidad $localidade): static
    {
        if ($this->localidades->removeElement($localidade)) {
            // set the owning side to null (unless already changed)
            if ($localidade->getProvincia() === $this) {
                $localidade->setProvincia(null);
            }
        }

        return $this;
    }
}
