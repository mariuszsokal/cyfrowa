<?php

namespace App\Logger;

use App\Logger\Handler\HandlerInterface;
use Psr\Log\AbstractLogger;
use App\Logger\Logger;
use App\Logger\Handler\FileHandler;

final class FileLogger
{
    private Logger $logger;

    public function __construct() {
        $handler = new FileHandler($this->getFilePath());
        $this->logger = new Logger($handler);
    }

    private function getFilePath(): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . date('Y-m-d') . '.log';
    }

    public function log(string $level, string $operationId, string $log) {
        $this->logger->log($level, sprintf('[%s] %s', $operationId, $log));
    }

    public function init(): string
    {
        return uniqid();
    }
}