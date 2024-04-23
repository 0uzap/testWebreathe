<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;


#[ORM\Entity(repositoryClass: ModuleRepository::class)]
#[ApiResource(paginationItemsPerPage: 20,
operations:[new Get(normalizationContext: ['groups' => 'module:item']),
            new Post(normalizationContext: ['groups' => 'module:item']),
            new GetCollection(normalizationContext: ['groups' => 'module:list']),
])]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['module:list', 'module:item'])]
    private ?int $id = null;

    /**
     * @var Collection<int, Mesures>
     */
    #[ORM\OneToMany(targetEntity: Mesures::class, mappedBy: 'module')]
    private Collection $mesures;

    #[ORM\Column(length: 255)]
    #[Groups(['module:list', 'module:item'])]
    private ?string $nom = null;

    public function __construct()
    {
        $this->mesures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Mesures>
     */
    public function getMesures(): Collection
    {
        return $this->mesures;
    }

    public function addMesure(Mesures $mesure): static
    {
        if (!$this->mesures->contains($mesure)) {
            $this->mesures->add($mesure);
            $mesure->setModule($this);
        }

        return $this;
    }

    public function removeMesure(Mesures $mesure): static
    {
        if ($this->mesures->removeElement($mesure)) {
            // set the owning side to null (unless already changed)
            if ($mesure->getModule() === $this) {
                $mesure->setModule(null);
            }
        }

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    
}
