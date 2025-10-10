<?php

namespace App\Entity;

use App\Repository\PlatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatsRepository::class)]
class Plats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, menu>
     */
    #[ORM\OneToMany(targetEntity: menu::class, mappedBy: 'plats')]
    private Collection $idmenu;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    public function __construct()
    {
        $this->idmenu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, menu>
     */
    public function getIdmenu(): Collection
    {
        return $this->idmenu;
    }

    public function addIdmenu(menu $idmenu): static
    {
        if (!$this->idmenu->contains($idmenu)) {
            $this->idmenu->add($idmenu);
            $idmenu->setPlats($this);
        }

        return $this;
    }

    public function removeIdmenu(menu $idmenu): static
    {
        if ($this->idmenu->removeElement($idmenu)) {
            // set the owning side to null (unless already changed)
            if ($idmenu->getPlats() === $this) {
                $idmenu->setPlats(null);
            }
        }

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }
}
