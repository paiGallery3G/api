<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Album;
use App\Entity\Image;
use App\Service\FileUploader;

#[AsController]
final class ImageFtypeController extends AbstractController
{
    public function __invoke(EntityManagerInterface $eManager, Request $request, FileUploader $fileUploader): Image
    {
        $entityManager = $eManager;
        $uploadedFile = $request->files->get('ftype');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"ftype" is required');
        }

        // create a new entity and set its values
        $image = new Image();

        //$albumIRI = "/api/album/" . $request->get('album');

        $album = $entityManager
            ->getRepository(Album::class)
            ->find($request->get('album'));

        if ($album == null) {
            throw new \Exception("Cannot find album with id: " . $request->get('album'));
        }

        $image->setAlbum($album);
        $image->setCreatedAt(null);
        $image->setDescription($request->get('description'));
        $image->setTitle($request->get('title'));
        $image->setAuthor($request->get('author'));


        // upload the file and save its filename
        $image->setFtype($fileUploader->upload($uploadedFile));

        return $image;
    }
}
