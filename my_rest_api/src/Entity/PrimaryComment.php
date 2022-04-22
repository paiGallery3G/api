<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PrimaryComment
 *
 * @ORM\Table(name="primary_comment")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity
 * @ApiResource()
 */
class PrimaryComment
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
     * @ORM\Column(name="content", type="text", length=65535, nullable=true, options={"default"="NULL"})
     * @Groups({"read", "write"})
     */
    private $content = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     * @Groups({"read"})
     */
    private $createdAt = null;

    /**
     * @ORM\ManyToOne(targetEntity=Image::class, inversedBy="p_comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"write"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=SecondaryComment::class, mappedBy="primaryComment")
     */
    private $s_comments;


    public function __construct()
    {
        $this->s_comments = new ArrayCollection();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

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

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, SecondaryComment>
     */
    public function getSComments(): Collection
    {
        return $this->s_comments;
    }

    public function addSComment(SecondaryComment $s_comment): self
    {
        if (!$this->s_comments->contains($s_comment)) {
            $this->s_comments[] = $s_comment;
            $s_comment->setPrimaryComment($this);
        }

        return $this;
    }

    public function removeSComment(SecondaryComment $s_comment): self
    {
        if ($this->s_comments->removeElement($s_comment)) {
            // set the owning side to null (unless already changed)
            if ($s_comment->getPrimaryComment() === $this) {
                $s_comment->setPrimaryComment(null);
            }
        }

        return $this;
    }


}
