<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\RepresentationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping\Index as INDEX;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use DateTimeInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups as Groups;

/**
 * @ORM\Table(indexes={
 *     @INDEX(name="representation_uuid_index", columns={"id"})
 * })
 * @ORM\Entity(repositoryClass=RepresentationsRepository::class)
 * @UniqueEntity("id")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 * @ApiResource(
 *     routePrefix="/api/v1/filials/",
 *     itemOperations={
 *      "get" = {
 *                  "normalization_context" = {
 *                      "groups" = {"representations:item:read"},
 *                      "skip_null_values" = false
 *                  },
 *                  "path" = "/representations/{id}",
 *                  "requirements" = {"id" : "[0-9a-f]{8}-[0-9a-f]{4}-[4][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}" }
 *              },
 *     },
 *     collectionOperations={
 *          "get" = {
 *                  "normalization_context" = {
 *                      "groups" = {"representations:read"},
 *                      "forceEager"=true
 *                  },
 *                  "path" = "/representations",
 *          },
 *          "dropdown" = {
 *                  "method" = "GET",
 *                  "path" = "/representations/dropdown",
 *                  "controller" = App\Controller\DropDown::class,
 *                  "normalization_context" = {"groups" = {"representations:read:dropdown"}},
 *                  "pagination_enabled" = false
 *          },
 *     },
 * )
 */
class Representations
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator("doctrine.uuid_generator")
     * @ApiProperty(writable=false)
     * @Groups({"representations:read", "representations:read:dropdown", "representations:item:read", "centers:item:read"})
     */
    private Uuid $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"representations:read", "representations:read:dropdown"})
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
     * Центры недвижимости для представительства
     * @ORM\OneToMany(targetEntity="App\Entity\Centers", mappedBy="representation", cascade={"persist", "remove"})
     * @ApiSubresource(maxDepth=1)
     */
    private iterable $centers;

    public function __construct()
    {
        $this->centers = new ArrayCollection();
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
     * @return ArrayCollection|iterable
     */
    public function getCenters(): iterable|ArrayCollection
    {
        return $this->centers;
    }

    /**
     * @param ArrayCollection|iterable $centers
     */
    public function setCenters(iterable|ArrayCollection $centers): void
    {
        $this->centers = $centers;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
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
