<?php
declare(strict_types=1);

namespace App\Infrastructure\Messenger\Test;

use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class Handler
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
    }

    public function __invoke(Model\TestMessage $message): void
    {
        $this->logger->info(\sprintf('Message received: %s, %s, %s', $message->id, $message->name, $message->description));
    }
}
