<?php

namespace WebFeletesDevelopers\MailSail\Test\Unit\Domain\EmailServer;

use PHPUnit\Framework\TestCase;
use WebFeletesDevelopers\MailSail\Domain\EmailServer\GoogleEmailServer;
use WebFeletesDevelopers\MailSail\Test\DataProvider\SMTPLoginData\SMTPLoginDataProvider;

/**
 * Class GoogleEmailServerTest
 * @package WebFeletesDevelopers\MailSail\Test\Unit\Domain\EmailServer
 * @author WebFeletesDevelopers
 */
class GoogleEmailServerTest extends TestCase
{
    /**
     * @test
     */
    public function handleHappyPath(): void
    {
        $loginData = SMTPLoginDataProvider::getSMTPLoginData();
        $sut = new GoogleEmailServer($loginData);

        $this->assertSame(
            $sut->host(),
            'smtp.gmail.com'
        );
        $this->assertSame(
            $sut->port(),
            587
        );
        $this->assertSame(
            $sut->debug(),
            false
        );
        $this->assertSame(
            $sut->encryption(),
            'tls'
        );
        $this->assertEquals(
            $sut->loginData(),
            $loginData
        );
    }
}
