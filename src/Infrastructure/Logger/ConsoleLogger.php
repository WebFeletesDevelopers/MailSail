<?php

namespace WebFeletesDevelopers\MailSail\Infrastructure\Logger;

use Psr\Log\AbstractLogger;

/**
 * Class ConsoleLogger
 * @package WebFeletesDevelopers\MailSail\Infrastructure\Logger
 * @author WebFeletesDevelopers
 */
class ConsoleLogger extends AbstractLogger
{
    /**
     * Default log message format: Date [level] - message.
     */
    private const MESSAGE_FORMAT = '%s: [%s] - %s';

    /**
     * Default log date format: Day Month Year Hour:Minutes:Seconds.
     */
    private const LOG_DATE_FORMAT = 'd m Y H:i:s';

    /**
     * Log a message using native echo function.
     *
     * @param mixed $level
     * @param string $message
     * @param array<string> $context
     */
    public function log($level, $message, array $context = array()): void
    {
        $date = date(self::LOG_DATE_FORMAT);

        $message = sprintf(
            self::MESSAGE_FORMAT,
            $date,
            $level,
            $message
        );
        echo $message . PHP_EOL;
    }
}
