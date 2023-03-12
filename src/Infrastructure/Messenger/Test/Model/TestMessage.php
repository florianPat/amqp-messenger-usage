<?php
declare(strict_types=1);

namespace App\Infrastructure\Messenger\Test\Model;

class TestMessage
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $description,
    ) {
    }
}
