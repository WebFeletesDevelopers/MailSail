<?php

namespace WebFeletesDevelopers\MailSail\Test\Integration\Application\UseCase\SendEmailUseCase;

use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\Framework\TestCase;
use WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase\SendEmailArguments;
use WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase\SendEmailUseCase;
use WebFeletesDevelopers\MailSail\Infrastructure\Email\PHPMailerEmailService;
use WebFeletesDevelopers\MailSail\Test\MaildevEmailServer\MaildevEmailServer;

/**
 * Class SendEmailUseCaseTest
 * @package WebFeletesDevelopers\MailSail\Test\Integration\Application\UseCase\SendEmailUseCase
 * @author WebFeletesDevelopers
 */
class SendEmailUseCaseTest extends TestCase
{
    private const EMAIL_FROM = 'prueba@oumama.com';
    private const EMAIL_TO = 'destino@oumama.com';
    private const EMAIL_SUBJECT = 'Asunto';
    private const EMAIL_BODY = '<b>Hola</b>';

    protected function setUp(): void
    {
        $this->deleteMailFromServer();
    }

    /**
     * @test
     */
    public function handleHappyPath(): void
    {
        $arguments = new SendEmailArguments(
            self::EMAIL_FROM,
            self::EMAIL_TO,
            self::EMAIL_SUBJECT,
            self::EMAIL_BODY,
            new MaildevEmailServer()
        );
        $useCase = new SendEmailUseCase(new PHPMailerEmailService(new PHPMailer()));

        $response = $useCase->handle($arguments);

        $emailData = $this->getMailDataFromAPI()[0];

        $this->assertTrue($response->success());
        $this->assertEmpty($response->error());

        $this->assertSame(
            self::EMAIL_FROM,
            $emailData['from'][0]['address']
        );
        $this->assertSame(
            self::EMAIL_TO,
            $emailData['to'][0]['address']
        );
        $this->assertSame(
            self::EMAIL_SUBJECT,
            $emailData['subject']
        );
        $this->assertSame(
            self::EMAIL_BODY,
            rtrim($emailData['html'])
        );

    }

    private function deleteMailFromServer(): void
    {
        $ch = curl_init('http://maildev:1080/email/all');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_exec($ch);
        curl_close($ch);
    }

    /**
     * @return array
     */
    private function getMailDataFromAPI(): array
    {
        $ch = curl_init('http://maildev:1080/email');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $raw = curl_exec($ch);
        $emailData = json_decode($raw, true);

        curl_close($ch);
        return $emailData;
    }
}