<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiProperty;
Use App\Controller\ImageFtypeController;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity
 * @ApiResource(
 *     normalizationContext={"groups" = {"read"}},
 *     denormalizationContext={"groups" = {"write"}},
 *     collectionOperations={
 *     "get",
 *     "post" = {
 *       "controller" = ImageFtypeController::class,
 *       "deserialize" = false,
 *        "openapi_context" = {
 *         "requestBody" = {
 *           "description" = "File upload to an existing resource (image)",
 *           "required" = true,
 *           "content" = {
 *             "multipart/form-data" = {
 *               "schema" = {
 *                 "type" = "object",
 *                 "properties" = {
 *                   "title" = {
 *                     "description" = "The title of the image",
 *                     "type" = "string",
 *                     "example" = "Fajne zdj z wakacji",
 *                   },
 *                   "author" = {
 *                     "description" = "The author of the image",
 *                     "type" = "string",
 *                     "example" = "Jan Kos",
 *                   },
 *                   "description" = {
 *                     "description" = "The description of the image",
 *                     "type" = "string",
 *
 *                   },
 *                     "album" = {
 *                     "description" = "The album's id",
 *                     "type" = "string",
 *                     "example" = "2",
 *                   },
 *                   "ftype" = {
 *                     "type" = "string",
 *                     "format" = "binary",
 *                     "description" = "Upload the image",
 *                   },
 *                 },
 *               },
 *             },
 *           },
 *         },
 *       },
 *        }
 *      }
 * )
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=64, nullable=true, options={"default"="NULL"})
     * @Groups({"read", "write"})
     */
    private $title = 'NULL';


    /**
     * @param string $ftype
     *
     * @ORM\Column(name="ftype", type="string", length=32)
     * @Groups({"read", "write"})
     * @ApiProperty(
     *   iri="https://schema.org/image",
     *   attributes={
     *     "openapi_context"={
     *       "type"="string",
     *     }
     *   }
     * )
     */
    private $ftype = null;

    /**
     * @var string|null
     *
     * @ORM\Column(name="author", type="string", length=64, nullable=true, options={"default"="NULL"})
     * @Groups({"read", "write"})
     */
    private $author = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true, options={"default"="NULL"})
     * @Groups({"read", "write"})
     */
    private $description = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     * @Groups({"read"})
     */
    private $createdAt = null;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="images")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity=Album::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"write"})
     */
    private $album;

    /**
     * @ORM\OneToMany(targetEntity=PrimaryComment::class, mappedBy="image")
     */
    private $p_comments;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->p_comments = new ArrayCollection();
    }

    /**
     * Prepersist gets triggered on Insert
     * @ORM\PrePersist
     */
    public function updatedTimestamps()
    {
        if ($this->createdAt == null or $this->createdAt == 'NULL') {
            $this->createdAt = new \DateTime('now');
        }
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getFtype(): ?string
    {
        return $this->ftype;
    }

    public function setFtype(?string $ftype): self
    {
        $this->ftype = $ftype;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }

    /**
     * @return Collection<int, PrimaryComment>
     */
    public function getPComments(): Collection
    {
        return $this->p_comments;
    }

    public function addPComment(PrimaryComment $pComment): self
    {
        if (!$this->p_comments->contains($pComment)) {
            $this->p_comments[] = $pComment;
            $pComment->setImage($this);
        }

        return $this;
    }

    public function removePComment(PrimaryComment $pComment): self
    {
        if ($this->p_comments->removeElement($pComment)) {
            // set the owning side to null (unless already changed)
            if ($pComment->getImage() === $this) {
                $pComment->setImage(null);
            }
        }

        return $this;
    }


}
