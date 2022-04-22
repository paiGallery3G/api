<?php

namespace App\Controller;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Image;
use App\Service\ImagesInAlbum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[ApiResource]
#[Route(path: "/api/albums/{albumId}/photos", name: "get_images_in_album")]
final class GetImagesInAlbum extends AbstractController
{
    private const DEFAULT_PAGE = 0;
    private const DEFAULT_ITEMS = 10;

    private SerializerInterface $serializer;
    private ImagesInAlbum $albumService;

    public function __construct(SerializerInterface $serializer, ImagesInAlbum $albumService)
    {
        $this->serializer = $serializer;
        $this->albumService = $albumService;
    }


    /**
     * @param Request $request
     * @param $albumId
     * @return JsonResponse
     */
    public function __invoke(Request $request, $albumId)
    {
        $page = $request->query->get('page');
        $page = $page == null ? self::DEFAULT_PAGE : $page;

        $items = $request->query->get('items');
        $items = $items == null ? self::DEFAULT_ITEMS : $items;

        $offset = $page * $items;

        $photos = $this->albumService->getImagesInAlbum($albumId, $items, $offset);

        return new JsonResponse($this->serializer->serialize($photos, JsonEncoder::FORMAT), Response::HTTP_OK, [], true);
    }
}
