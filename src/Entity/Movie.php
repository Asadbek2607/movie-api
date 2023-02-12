<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\Movie\MovieDeleteAction;
use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;
#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(),
        new Put(),
        new Delete(
            uriTemplate: '/movies/{id}',
            controller: MovieDeleteAction::class,
            name: 'softDelete'
        ),
        new Get(),
    ],
    normalizationContext: ['groups' => ['movie:read']],
    denormalizationContext: ['groups' => ['movie:write','media_object:write']],
)]
#[ApiFilter(SearchFilter::class, properties: [
    'id' => 'exact',
    'name' => 'partial',
    'description' => 'partial',
    'text' => 'partial',
    'category' => 'exact'
])]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['movie:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['movie:read', 'movie:write', 'category:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['movie:read', 'movie:write'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['movie:read', 'movie:write'])]
    private ?Category $category = null;

    #[ORM\Column]
    #[Groups(['movie:read', 'movie:write'])]
    private ?int $year = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deletedAt = null;

    #[ORM\ManyToOne]
    #[Groups(['movie:read', 'movie:write'])]
    private ?MediaObject $cardImage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getCardImage(): ?MediaObject
    {
        return $this->cardImage;
    }

    public function setCardImage(?MediaObject $cardImage): self
    {
        $this->cardImage = $cardImage;

        return $this;
    }
    
}
