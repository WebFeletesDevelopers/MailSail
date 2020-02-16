<?php

namespace WebFeletesDevelopers\MailSail\Infrastructure\Logger;

/**
 * Class ConsoleLogger
 * @package WebFeletesDevelopers\MailSail\Infrastructure\Logger
 * @author WebFeletesDevelopers
 */
class ConsoleLogger extends \Psr\Log\AbstractLogger
{
    private const MESSAGE_FORMAT = '%s: [%s] - %s';
    private const LOG_DATE_FORMAT = 'd m Y H:i:s';

    /**
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
