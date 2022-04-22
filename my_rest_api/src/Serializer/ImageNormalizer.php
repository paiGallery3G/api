<?php


namespace App\Serializer;

use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use App\Service\FileUploader;
use App\Entity\Image;

final class ImageNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    private FileUploader $fileUploader;
    public const ALREADY_CALLED = 'IMAGE_OBJECT_NORMALIZER_ALREADY_CALLED';

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = []): bool
    {
        return !isset($context[self::ALREADY_CALLED]) && $data instanceof Image;
    }

    public function normalize($object, ?string $format = null, array $context = [])
    {
        $context[self::ALREADY_CALLED] = true;

        // update the cover with the url
        $object->setFtype($this->fileUploader->getUrl($object->getFtype()));

        return $this->normalizer->normalize($object, $format, $context);
    }
}