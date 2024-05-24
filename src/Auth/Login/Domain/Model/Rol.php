<?php
namespace App\Auth\Login\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'rol')]
class Rol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 55, unique: true)]
    private string $name;

    #[ORM\ManyToMany(targetEntity: Usuario::class, mappedBy: 'roles')]
    private Collection $users;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->users = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Usuario $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addRole($this);
        }

        return $this;
    }

    public function removeUser(Usuario $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeRole($this);
        }

        return $this;
    }
}
