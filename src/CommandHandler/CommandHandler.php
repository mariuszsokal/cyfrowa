<?php
declare(strict_types=1);

namespace App\Application\CommandHandler;

use CommandHandlerNotFoundException;

final class CommandHandler
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
}