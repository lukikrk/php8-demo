<?php

declare(strict_types=1);

namespace App\Infrastructure\Serialization\Normalizer;

use App\Domain\Entity\Exercise;
use Symfony\Component\Serializer\Encoder\NormalizationAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ExerciseNormalizer implements NormalizerInterface, NormalizationAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * @param Exercise $object
     * @param string|null $format
     * @param array $context
     *
     * @return array
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'id' => $object->getId()->toString(),
            'name' => $object->getName()->getValue(),
            'description' => $object->getDescription(),
            'expertOpinion' => $object->getExpertOpinion(),
            'country' => $object?->getUser()?->getAddress()?->getCountry()
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Exercise;
    }
}
