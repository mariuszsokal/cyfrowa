<?php
declare(strict_types=1);

namespace App\Application\Bus;

use QueryHandlerNotFoundException;
use App\Application\Query\QueryInterface;

final class QueryBus
{
    private array $handlers;

    public function __construct(array $handlers) {
        dump('in query bus construct');
        dump($handlers);
        $this->handlers = $handlers;
    }

    public function getQueryHandler(string $query): object
    {
        if(isset($this->handlers[$query])) {
            return $this->handlers[$query];
        }
        
        throw new QueryHandlerNotFoundException();
    }

    public function handle(QueryInterface $query) {
        $handler = $this->getQueryHandler(get_class($query));
        //invoke handler class
    }
}