<?php

namespace WebFeletesDevelopers\MailSail\Test\Unit\Infrastructure\Email;

use Exception;
use Mockery as m;
use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\Framework\TestCase;
use WebFeletesDevelopers\MailSail\Domain\EmailServer\EmailServerInterface;
use WebFeletesDevelopers\MailSail\Infrastructure\Email\PHPMailerEmailService;
use WebFeletesDevelopers\MailSail\Infrastructure\Email\PHPMailerEmailServiceException;
use WebFeletesDevelopers\MailSail\Test\DataProvider\Email\EmailDataProvider;
use WebFeletesDevelopers\MailSail\Test\DataProvider\SMTPLoginData\SMTPLoginDataProvider;

class PHPMailerEmailServiceTest extends TestCase
{
    private const SMTP_HOST = 'host.com';
    private const SMTP_PORT = 1248;

    protected function tearDown(): void
    {
        m::close();
    }

    /**
     * @test
     */
    public function handleHappyPath(): void
    {
        $loginData = SMTPLoginDataProvider::getSMTPLoginData();
        $emailServer = m::mock(EmailServerInterface::class);
        $emailServer->shouldReceive('debug')->andReturn(true);
        $emailServer->shouldReceive('host')->andReturn(self::SMTP_HOST);
        $emailServer->shouldReceive('port')->andReturn(self::SMTP_PORT);
        $emailServer->shouldReceive('loginData')->andReturn($loginData);
        $emailServer->shouldReceive('encryption')->andReturn('tls');

        $phpMailer = m::mock(PHPMailer::class);
        $phpMailer->shouldReceive('isSMTP');
        $phpMailer->shouldReceive('setFrom')->with(EmailDataProvider::EMAIL_FROM);
        $phpMailer->shouldReceive('addAddress')->with(EmailDataProvider::EMAIL_TO);
        $phpMailer->shouldReceive('msgHtml')->with(EmailDataProvider::EMAIL_BODY);
        $phpMailer->shouldReceive('send')->andReturn(true);

        $sut = new PHPMailerEmailService($phpMailer);

        $result = $sut->send(
            $emailServer,
            EmailDataProvider::getOne()
        );

        $this->assertTrue($result);
        $this->assertSame(
            self::SMTP_HOST,
            $phpMailer->Host
        );
        $this->assertSame(
            self::SMTP_PORT,
            $phpMailer->Port
        );
        $this->assertTrue($phpMailer->SMTPAuth);
        $this->assertSame(
            SMTPLoginDataProvider::LOGIN_USER,
            $phpMailer->Username
        );
        $this->assertSame(
            SMTPLoginDataProvider::LOGIN_PASSWORD,
            $phpMailer->Password
        );
        $this->assertSame(
            'tls',
            $phpMailer->SMTPSecure
        );
        $this->assertSame(
            EmailDataProvider::EMAIL_SUBJECT,
            $phpMailer->Subject
        );
    }

    /**
     * @test
     */
    public function handleMailerError(): void
    {
        $this->expectException(PHPMailerEmailServiceException::class);
        $emailServer = m::mock(EmailServerInterface::class);

        $phpMailer = m::mock(PHPMailer::class);
        $phpMailer->shouldReceive('isSMTP')->andThrow(Exception::class);

        $sut = new PHPMailerEmailService($phpMailer);

        $sut->send(
            $emailServer,
            EmailDataProvider::getOne()
        );
    }

    /**
     * @test
     */
    public function handleSendError(): void
    {
        $this->expectException(PHPMailerEmailServiceException::class);
        $loginData = SMTPLoginDataProvider::getSMTPLoginData();
        $emailServer = m::mock(EmailServerInterface::class);
        $emailServer->shouldReceive('debug')->andReturn(true);
        $emailServer->shouldReceive('host')->andReturn(self::SMTP_HOST);
        $emailServer->shouldReceive('port')->andReturn(self::SMTP_PORT);
        $emailServer->shouldReceive('loginData')->andReturn($loginData);
        $emailServer->shouldReceive('encryption')->andReturn('tls');

        $phpMailer = m::mock(PHPMailer::class);
        $phpMailer->shouldReceive('isSMTP');
        $phpMailer->shouldReceive('setFrom')->with(EmailDataProvider::EMAIL_FROM);
        $phpMailer->shouldReceive('addAddress')->with(EmailDataProvider::EMAIL_TO);
        $phpMailer->shouldReceive('msgHtml')->with(EmailDataProvider::EMAIL_BODY);
        $phpMailer->shouldReceive('send')->andReturn(false);

        $sut = new PHPMailerEmailService($phpMailer);

        $sut->send(
            $emailServer,
            EmailDataProvider::getOne()
        );
    }
}