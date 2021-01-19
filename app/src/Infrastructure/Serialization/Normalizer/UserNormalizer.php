<?php

declare(strict_types=1);

namespace App\Infrastructure\Serialization\Normalizer;

use App\Domain\Entity\User;
use Symfony\Component\Serializer\Encoder\NormalizationAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserNormalizer implements NormalizerInterface, NormalizationAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * @param User $object
     * @param string|null $format
     * @param array $context
     *
     * @return array
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'id' => $object->getId()->toString(),
            'firstName' => $object->getFirstName(),
            'lastName' => $object->getLastName(),
            'weight' => $object->getWeight(),
            'height' => $object->getHeight(),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof User;
    }
}
