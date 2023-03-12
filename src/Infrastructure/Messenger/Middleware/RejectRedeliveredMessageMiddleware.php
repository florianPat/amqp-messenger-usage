<?php
declare(strict_types=1);

namespace App\Infrastructure\Messenger\Middleware;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\StackInterface;

class RejectRedeliveredMessageMiddleware extends \Symfony\Component\Messenger\Middleware\RejectRedeliveredMessageMiddleware
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        return $stack->next()->handle($envelope, $stack);
    }
}
