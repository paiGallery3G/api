<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity
 * @ApiResource(
 *     normalizationContext={"groups" = {"read"}},
 *     denormalizationContext={"groups" = {"write"}}
 * )
 */
class Album
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
     * @ORM\Column(name="created_at", type="date", nullable=true, options={"default"="NULL"})
     * @Groups({"read"})
     */
    private $createdAt = 'NULL';

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="albums")
     * @Groups({"read", "write"})
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="album")
     * @Groups({"read"})
     */
    private $images;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAlbum($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAlbum() === $this) {
                $image->setAlbum(null);
            }
        }

        return $this;
    }


}
