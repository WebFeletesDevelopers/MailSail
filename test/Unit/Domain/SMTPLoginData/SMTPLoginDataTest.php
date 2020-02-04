<?php

namespace WebFeletesDevelopers\MailSail\Test\Unit\Domain\SMTPLoginData;

use PHPUnit\Framework\TestCase;
use WebFeletesDevelopers\MailSail\Domain\SMTPLoginData\SMTPLoginData;

/**
 * Class SMTPLoginDataTest
 * @package WebFeletesDevelopers\MailSail\Test\Unit\Domain\SMTPLoginData
 * @author WebFeletesDevelopers
 */
class SMTPLoginDataTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCreateLoginData(): void
    {
        $username = 'the SMTP username';
        $password = 'a very secure password';

        $sut = new SMTPLoginData($username, $password);

        $this->assertSame(
            $username,
            $sut->user()
        );
        $this->assertSame(
            $password,
            $sut->password()
        );
    }
}
