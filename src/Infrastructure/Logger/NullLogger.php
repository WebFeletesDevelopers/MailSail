<?php

namespace WebFeletesDevelopers\MailSail\Infrastructure\Logger;

use Psr\Log\AbstractLogger;

/**
 * Class NullLogger
 * @package WebFeletesDevelopers\MailSail\Infrastructure\Logger
 * @author WebFeletesDevelopers
 */
class NullLogger extends AbstractLogger
{
    /**
     * Do literally nothing. This class is used to supply a Logger to a class that needs
     * a class implementing PSR-3 LoggerInterface, but you don't want to log anything.
     *
     * @param mixed $level
     * @param string $message
     * @param array<string> $context
     */
    public function log($level, $message, array $context = array()): void
    {
        // Doing absolutely nothing.
    }
}
