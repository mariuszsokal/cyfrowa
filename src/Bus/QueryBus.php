<?php
declare(strict_types=1);

namespace App\Bus;

use QueryHandlerNotFoundException;
use App\Application\Query\QueryInterface;

final class QueryBus
{
    private array $handlers;
    private $container;

    public function __construct(array $handlers, $container) {
        foreach($handlers as $key => $rewindable) {
            foreach($rewindable as $handler) {
                $this->handlers[$this->getHandlerKey(get_class($handler))] = get_class($handler);
                unset($key);
            }
        }
        reset($container);
        $this->container = $container[key($container)];
    }

    private function getHandlerKey(string $handler) {
        return str_replace('QueryHandler', 'Query', $handler);
    }

    public function getQueryHandler(string $query): string
    {
        if(isset($this->handlers[$query])) {
            return $this->handlers[$query];
        }
        
        throw new QueryHandlerNotFoundException();
    }

    public function handle(QueryInterface $query) {
        $handlerClass = $this->getQueryHandler(get_class($query));
        $service = $this->container->get($handlerClass);
        return $service($query);
    }
}