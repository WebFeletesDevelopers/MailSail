<?php

namespace WebFeletesDevelopers\MailSail\Test\Unit\Infrastructure\Logger;

use PHPUnit\Framework\TestCase;
use WebFeletesDevelopers\MailSail\Infrastructure\Logger\ConsoleLogger;

/**
 * Class ConsoleLoggerTest
 * @package WebFeletesDevelopers\MailSail\Test\Unit\Infrastructure\Logger
 * @author WebFeletesDevelopers
 */
class ConsoleLoggerTest extends TestCase
{
    /**
     * @test
     */
    public function handleLog(): void
    {
        $sut = new ConsoleLogger();

        $sut->debug('message');
        $this->expectOutputRegex('#.*\: \[debug\] - message\\n#');
    }
}
