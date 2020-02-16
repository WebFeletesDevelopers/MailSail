<?php

namespace WebFeletesDevelopers\MailSail\Test\Unit\Infrastructure\Logger;

use PHPUnit\Framework\TestCase;
use WebFeletesDevelopers\MailSail\Infrastructure\Logger\NullLogger;

/**
 * Class NullLoggerTest
 * @package WebFeletesDevelopers\MailSail\Test\Unit\Infrastructure\Logger
 * @author WebFeletesDevelopers
 */
class NullLoggerTest extends TestCase
{
    /**
     * @test
     */
    public function handleLog(): void
    {
        $sut = new NullLogger();
        $sut->debug('message');

        $this->expectOutputString('');
    }
}
