<?php

namespace App\Entity;

use App\Repository\MesuresRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;

#[ORM\Entity(repositoryClass: MesuresRepository::class)]
#[ApiResource(paginationItemsPerPage: 20,
operations:[new Get(normalizationContext: ['groups' => 'mesures:item']),
            new Post(normalizationContext: ['groups' => 'mesures:item']),
            new GetCollection(normalizationContext: ['groups' => 'mesures:list']),
])]
class Mesures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['mesures:list', 'mesures:item', 'module:list', 'module:item', 'donneesNumeriques:list', 'donneesNumeriques:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['mesures:list', 'mesures:item', 'module:list', 'module:item', 'donneesNumeriques:list', 'donneesNumeriques:item'])]
    private ?string $valeur = null;

    #[ORM\ManyToOne(inversedBy: 'mesures')]
    private ?Module $module = null;

    #[ORM\ManyToOne(inversedBy: 'mesures')]
    private ?DonneesNumeriques $donneesNumeriques = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['mesures:list', 'mesures:item', 'module:list', 'module:item', 'donneesNumeriques:list', 'donneesNumeriques:item'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 25, nullable: true)]
    #[Groups(['mesures:list', 'mesures:item', 'module:list', 'module:item', 'donneesNumeriques:list', 'donneesNumeriques:item'])]
    private ?string $etatModule = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(?string $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }

    public function getDonneesNumeriques(): ?DonneesNumeriques
    {
        return $this->donneesNumeriques;
    }

    public function setDonneesNumeriques(?DonneesNumeriques $donneesNumeriques): static
    {
        $this->donneesNumeriques = $donneesNumeriques;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getEtatModule(): ?string
    {
        return $this->etatModule;
    }

    public function setEtatModule(?string $etatModule): static
    {
        $this->etatModule = $etatModule;

        return $this;
    }

}
