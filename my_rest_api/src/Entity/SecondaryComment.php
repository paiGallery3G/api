<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * SecondaryComment
 *
 * @ORM\Table(name="secondary_comment")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity
 * @ApiResource(
 *     normalizationContext={"groups" = {"read"}},
 *     denormalizationContext={"groups" = {"write"}}
 * )
 */
class SecondaryComment
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
     * @ORM\Column(name="created_at", type="date", nullable=true, options={"default"="NULL"})
     * @Groups({"read"})
     */
    private $createdAt = 'NULL';

    /**
     * @ORM\ManyToOne(targetEntity=PrimaryComment::class, inversedBy="s_comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"write"})
     */
    private $primaryComment;

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

    public function getPrimaryComment(): ?PrimaryComment
    {
        return $this->primaryComment;
    }

    public function setPrimaryComment(?PrimaryComment $primaryComment): self
    {
        $this->primaryComment = $primaryComment;

        return $this;
    }


}
