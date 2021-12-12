<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CentersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping\Index as INDEX;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use DateTimeInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Services\Validators\I18nNameDeclination;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Groups as GroupsEntity;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ORM\Entity(repositoryClass=CentersRepository::class)
 * @ORM\Table(indexes={
 *     @INDEX(name="centersn_uuid_index", columns={"id"}),
 *     @INDEX(name="centers_representation_index", columns={"representation_id"}),
 *     @INDEX(name="centers_group_index", columns={"group_id"})
 * })
 * @UniqueEntity("id")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 * @ApiResource(
 *     routePrefix="/api/v1/filials/",
 *     itemOperations={
 *      "get" = {
 *              "normalization_context" = {"groups" = {"centers:item:read"}},
 *              "path" = "/centers/{id}",
 *              "requirements" = {"id" : "[0-9a-f]{8}-[0-9a-f]{4}-[4][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}" }
 *          }
 *      },
 *     collectionOperations={
 *      "get" = {
 *              "normalization_context" = {"groups" = {"centers:read"}},
 *              "path" = "/centers",
 *          },
 *     "dropdown" = {
 *              "method" = "GET",
 *              "path" = "/centers/dropdown",
 *              "controller" = App\Controller\DropDown::class,
 *              "normalization_context" = {"groups" = {"centers:read:dropdown"}},
 *              "pagination_enabled" = false,
 *          },
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={"representation": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"createdAt"}, arguments={"orderParameterName": "order"})
 */
class Centers
{
    /**
     * The id of the center
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true, nullable=false)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator("doctrine.uuid_generator")
     * @ApiProperty(writable=false)
     * @Groups({"centers:read", "centers:item:read", "centers:read:dropdown"})
     */
    private Uuid $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Representations", inversedBy="centers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"centers:item:read"})
     * @ApiProperty(fetchEager=true)
     */
    private Representations $representation;

    /**
     * Группа
     * @ORM\ManyToOne(targetEntity="App\Entity\Groups", inversedBy="centers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"centers:item:read"})
     * @ApiProperty(fetchEager=true)
     */
    private GroupsEntity $group;

    /**
     * @ORM\Column(type="text")
     * @Groups({"centers:item:read", "centers:read", "centers:read:dropdown"})
     */
    private string $name;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    private ?DateTimeInterface $createdAt = null;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="update")
     */
    private ?DateTimeInterface $updatedAt = null;

    /**
     * @ORM\Column(type="datetime", name="deleted_at", nullable=true)
     */
    private ?DateTimeInterface $deletedAt;

    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return Representations
     */
    public function getRepresentation(): Representations
    {
        return $this->representation;
    }

    /**
     * @return GroupsEntity
     */
    public function getGroup(): GroupsEntity
    {
        return $this->group;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Representations $representation
     */
    public function setRepresentation(Representations $representation): void
    {
        $this->representation = $representation;
    }

    /**
     * @param GroupsEntity $group
     */
    public function setGroup(GroupsEntity $group): void
    {
        $this->group = $group;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

}
