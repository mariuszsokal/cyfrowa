<?php
declare(strict_types=1);

namespace App\Bus;

use CommandHandlerNotFoundException;
use App\Application\Command\CommandInterface;

final class CommandBus
{
    private array $handlers;

    public function __construct(array $handlers) {
        foreach($handlers as $key => $rewindable) {
            foreach($rewindable as $handler) {
                $this->handlers[$this->getHandlerKey(get_class($handler))] = get_class($handler);
                unset($key);
            }
        }
    }

    private function getHandlerKey(string $handler) {
        return str_replace('CommandHandler', 'Command', $handler);
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