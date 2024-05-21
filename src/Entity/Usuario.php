<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $telefono = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $foto = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\ManyToOne(inversedBy: 'usuarios')]
    private ?Localidad $localidad = null;

    /**
     * @var Collection<int, Valoracion>
     */
    #[ORM\OneToMany(targetEntity: Valoracion::class, mappedBy: 'usuario')]
    private Collection $valoraciones;

    /**
     * @var Collection<int, Presupuesto>
     */
    #[ORM\OneToMany(targetEntity: Presupuesto::class, mappedBy: 'usuario')]
    private Collection $presupuestos;

    /**
     * @var Collection<int, Factura>
     */
    #[ORM\OneToMany(targetEntity: Factura::class, mappedBy: 'usuario')]
    private Collection $facturas;

    public function __construct()
    {
        $this->valoraciones = new ArrayCollection();
        $this->presupuestos = new ArrayCollection();
        $this->facturas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): static
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): static
    {
        $this->foto = $foto;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getLocalidad(): ?Localidad
    {
        return $this->localidad;
    }

    public function setLocalidad(?Localidad $localidad): static
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * @return Collection<int, Valoracion>
     */
    public function getValoraciones(): Collection
    {
        return $this->valoraciones;
    }

    public function addValoracione(Valoracion $valoracione): static
    {
        if (!$this->valoraciones->contains($valoracione)) {
            $this->valoraciones->add($valoracione);
            $valoracione->setUsuario($this);
        }

        return $this;
    }

    public function removeValoracione(Valoracion $valoracione): static
    {
        if ($this->valoraciones->removeElement($valoracione)) {
            // set the owning side to null (unless already changed)
            if ($valoracione->getUsuario() === $this) {
                $valoracione->setUsuario(null);
            }
        }

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
            $presupuesto->setUsuario($this);
        }

        return $this;
    }

    public function removePresupuesto(Presupuesto $presupuesto): static
    {
        if ($this->presupuestos->removeElement($presupuesto)) {
            // set the owning side to null (unless already changed)
            if ($presupuesto->getUsuario() === $this) {
                $presupuesto->setUsuario(null);
            }
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
            $factura->setUsuario($this);
        }

        return $this;
    }

    public function removeFactura(Factura $factura): static
    {
        if ($this->facturas->removeElement($factura)) {
            // set the owning side to null (unless already changed)
            if ($factura->getUsuario() === $this) {
                $factura->setUsuario(null);
            }
        }

        return $this;
    }

    public function setVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function __toString(){
        return $this->getFullName();
    }

    public function getFullName(): string
    {
        return $this->getNombre() . ' ' . $this->getApellidos();
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'nombre' => $this->getNombre(),
            'apellidos' => $this->getApellidos(),
            'foto' => $this->getFoto(),
            'isVerified' => $this->isVerified(),
            'roles' => $this->getRoles()
        ];
    }

}
