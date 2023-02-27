<?php

namespace App\Logger;

use App\Logger\Handler\HandlerInterface;
use Psr\Log\AbstractLogger;

final class Logger extends AbstractLogger
{
    protected const DEFAULT_DATETIME_FORMAT = 'c';
    private HandlerInterface $handler;

    public function __construct(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    public function log($level, $message, array $context = []): void
    {
        $this->handler->handle([
            'message' => self::interpolate((string)$message, $context),
            'level' => strtoupper($level),
            'timestamp' => (new \DateTimeImmutable())->format(self::DEFAULT_DATETIME_FORMAT),
        ]);
    }

    protected static function interpolate(string $message, array $context = []): string
    {
        $replace = [];
        foreach ($context as $key => $val) {
            if (is_string($val) || method_exists($val, '__toString')) {
                $replace['{' . $key . '}'] = $val;
            }
        }
        return strtr($message, $replace);
    }
}