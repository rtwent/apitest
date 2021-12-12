<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\GroupsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping\Index as INDEX;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use DateTimeInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups as GroupsAnnotation;

/**
 * @ORM\Entity(repositoryClass=GroupsRepository::class)
 * @ORM\Table(indexes={
 *     @INDEX(name="groups_uuid_index", columns={"id"}),
 * })
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("id")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 * @ApiResource(
 *     routePrefix="/api/v1/filials/",
 *     itemOperations={
 *          "get" = {
 *                      "normalization_context" = {"groups" = {"groups:item:read"}},
 *                      "path" = "/groups/{id}",
 *                      "requirements" = {"id" : "[0-9a-f]{8}-[0-9a-f]{4}-[4][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}" }
 *                  },
 *     },
 *     collectionOperations={
 *          "dropdown" = {
 *                  "method" = "GET",
 *                  "path" = "/groups/dropdown",
 *                  "controller" = App\Controller\DropDown::class,
 *                  "normalization_context" = {"groups" = {"groups:read"}},
 *                  "pagination_enabled" = false
 *          },
 *     },
 * )
 */
class Groups
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator("doctrine.uuid_generator")
     * @GroupsAnnotation({"groups:read", "groups:item:read", "centers:read"})
     * @ApiProperty(writable=false)
     */
    private Uuid $id;

    /**
     * @ORM\Column(type="text")
     * @GroupsAnnotation({"groups:read", "groups:item:read", "centers:read"})
     */
    private string $name;


    /**
     * Дата создания
     * @var DateTimeInterface|null
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    private ?DateTimeInterface $createdAt = null;

    /**
     * Дата редактирования
     * @var DateTimeInterface|null
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="update")
     */
    private ?DateTimeInterface $updatedAt = null;

    /**
     * Дата удаления
     * @ORM\Column(type="datetime", name="deleted_at", nullable=true)
     */
    private ?DateTimeInterface $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Centers", mappedBy="group", cascade={"persist", "remove"})
     * @GroupsAnnotation({"groups:item:read"})
     * @ApiSubresource(maxDepth=1)
     */
    private iterable $centers;

    public function __construct()
    {
        $this->centers = new ArrayCollection();
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @ApiProperty(writableLink=true)
     * @return Collection<Centers>
     */
    public function getCenters(): Collection
    {
        return $this->centers;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }


}
