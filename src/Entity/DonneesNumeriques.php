<?php

namespace App\Entity;

use App\Repository\DonneesNumeriquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;

#[ORM\Entity(repositoryClass: DonneesNumeriquesRepository::class)]
#[ApiResource(paginationItemsPerPage: 20,
operations:[new Get(normalizationContext: ['groups' => 'donneesNumeriques:item']),
            new Post(normalizationContext: ['groups' => 'donneesNumeriques:item']),
            new GetCollection(normalizationContext: ['groups' => 'donneesNumeriques:list']),
])]
class DonneesNumeriques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['donneesNumeriques:list', 'donneesNumeriques:item'])]
    private ?int $id = null;

    /**
     * @var Collection<int, Mesures>
     */
    #[ORM\OneToMany(targetEntity: Mesures::class, mappedBy: 'donneesNumeriques')]
    private Collection $mesures;

    #[ORM\Column(length: 255)]
    #[Groups(['donneesNumeriques:list', 'donneesNumeriques:item'])]
    private ?string $type = null;

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
            $mesure->setDonneesNumeriques($this);
        }

        return $this;
    }

    public function removeMesure(Mesures $mesure): static
    {
        if ($this->mesures->removeElement($mesure)) {
            // set the owning side to null (unless already changed)
            if ($mesure->getDonneesNumeriques() === $this) {
                $mesure->setDonneesNumeriques(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
