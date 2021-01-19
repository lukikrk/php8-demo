<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractBaseController
{
    public function __construct(protected MessageBusInterface $messageBus, private SerializerInterface $serializer)
    {}

    protected function jsonResponse(
        mixed $data = null,
        int $statusCode = Response::HTTP_OK,
        array $serializationContext = [],
        array $headers = []
    ): Response {
        return JsonResponse::fromJsonString(
            $this->serializer->serialize(['data' => $data], 'json', $serializationContext),
            $statusCode,
            $headers
        );
    }

    protected function responseFromEnvelope(Envelope $envelope, int $statusCode = Response::HTTP_OK): Response
    {
        /** @var HandledStamp $lastStamp */
        $lastStamp = $envelope->last(HandledStamp::class);

        return $this->jsonResponse($lastStamp->getResult(), $statusCode);
    }
}
