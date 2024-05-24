<?php
namespace App\Auth\Login\Domain\Model;

use App\Auth\Login\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepositoryInterface::class)]
#[ORM\Table(name: 'usuario')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    #[Assert\Length(min: 5)]
    #[Assert\Regex(
        pattern: "/^[a-zA-Z]+$/",
        message: "El nombre solo debe contener letras."
    )]
    private string $nombre;

    #[ORM\Column(length: 55, unique: true)]
    private string $usuario;

    #[ORM\Column(length: 255)]
    private string $contrasena;

    #[ORM\Column]
    private bool $estado; 

    #[ORM\Column]
    private bool $tiene_captcha;


    #[ORM\ManyToMany(targetEntity: Rol::class, inversedBy: 'users', cascade: ['persist'])]
    #[ORM\JoinTable(name: 'user_roles')]
    private Collection $roles;

    public function __construct(string $nombre, string $usuario, string $contrasena, bool $tiene_captcha, bool $estado, array $roles = [])
    {
        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this-> estado = $estado;
        $this->contrasena = $contrasena;
        $this->tiene_captcha = $tiene_captcha;
        $this->roles = new ArrayCollection($roles);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function getPassword(): string
    {
        return $this->contrasena;
    }

    public function getRoles(): array
    {
        $roles = $this->roles->map(fn(Rol $role) => $role->getName())->toArray();
        return array_unique($roles);
    }

    public function addRole(Rol $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }

        return $this;
    }

    public function removeRole(Rol $role): self
    {
        $this->roles->removeElement($role);
        return $this;
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->usuario;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getTieneCaptcha()
    {
        return $this->tiene_captcha;
    }

    public function setTieneCaptcha($tiene_captcha)
    {
        $this->tiene_captcha = $tiene_captcha;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function setPassword($contrasena)
    {
        $this->contrasena = $contrasena;
        return $this;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }
    
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}
