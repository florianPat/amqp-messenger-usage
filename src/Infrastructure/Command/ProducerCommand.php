<?php
declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Infrastructure\Messenger\Test\Model\TestMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'app:producer')]
class ProducerCommand extends Command
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): never
    {
        $i = 0;

        while(true) {
            $this->messageBus->dispatch(
                new TestMessage(
                    (string) $i++,
                    'A name',
                    'A description',
                ),
            );
            $output->writeln(\sprintf('Write message %s to rabbitmq', (string) $i));
        }
    }
}