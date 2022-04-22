<?php

namespace App\Service;

use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;

class ImagesInAlbum
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $album
     * @param float|bool|int|string $items
     * @param float|int $offset
     * @return array|object[]
     */
    public function getImagesInAlbum($album, float|bool|int|string $items, float|int $offset): array
    {
        return  $this->entityManager
            ->getRepository(Image::class)
            ->findBy(criteria: ['album' => $album], limit: $items, offset: $offset);
    }
}