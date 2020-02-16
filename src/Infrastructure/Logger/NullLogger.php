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
     * @param mixed $level
     * @param string $message
     * @param array<string> $context
     */
    public function log($level, $message, array $context = array()): void
    {
        // Doing absolutely nothing.
    }
}
