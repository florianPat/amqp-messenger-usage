<?php
declare(strict_types=1);

namespace App\Infrastructure\Messenger\Test;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\Serializer;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class MessageSerializer implements SerializerInterface
{
    private readonly SerializerInterface $serializer;

    public function __construct(
    ) {
        $this->serializer = new Serializer(
            new \Symfony\Component\Serializer\Serializer(
                [
                    new DateTimeNormalizer(),
                    new BackedEnumNormalizer(),
                    new ArrayDenormalizer(),
                    new ObjectNormalizer(),
                ],
                [
                    new JsonEncoder(),
                ],
            ),
        );
    }

    public function decode(array $encodedEnvelope): Envelope
    {
        return $this->serializer->decode(
            \array_replace_recursive(
                $encodedEnvelope,
                ['headers' => ['type' => Model\TestMessage::class]],
            )
        );
    }

    public function encode(Envelope $envelope): array
    {
        return $this->serializer->encode($envelope);
    }
}