<?php
declare(strict_types=1);

namespace App\Application\Bus;

use CommandHandlerNotFoundException;
use App\Application\Command\CommandInterface;

final class CommandBus
{
    private array $handlers;

    public function __construct(array $handlers) {
        $this->handlers = $handlers;
    }

    public function getCommandHandler(string $command): object
    {
        if(isset($this->handlers[$command])) {
            return $this->handlers[$command];
        }
        
        throw new CommandHandlerNotFoundException();
    }

    public function handle(CommandInterface $command) {
        $handlerClass = $this->getCommandHandler(get_class($command));
        $handler = (new $handlerClass($command))();

        //invoke handler class
    }
}