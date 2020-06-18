<?php

namespace WebFeletesDevelopers\MailSail\Test\Integration\Application\UseCase\SendEmailUseCase;

use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\Framework\TestCase;
use WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase\SendEmailArguments;
use WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase\SendEmailUseCase;
use WebFeletesDevelopers\MailSail\Infrastructure\Email\PHPMailerEmailService;
use WebFeletesDevelopers\MailSail\Infrastructure\Logger\NullLogger;
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
            self::EMAIL_BODY
        );
        $useCase = new SendEmailUseCase(
            new PHPMailerEmailService(
                new PHPMailer(),
                new NullLogger(),
                new MaildevEmailServer()
            )
        );

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

        if ($ch === false) {
            $this->fail('Curl handler broke');
            return;
        }

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_exec($ch);
        curl_close($ch);
    }

    /**
     * @return array<array>
     */
    private function getMailDataFromAPI(): array
    {
        $ch = curl_init('http://maildev:1080/email');

        if ($ch === false) {
            $this->fail('Curl handler broke');
            return [];
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $raw = curl_exec($ch);

        if (! is_string($raw)) {
            $this->fail('Failed to recover data from the API');
            return [];
        }
        $emailData = json_decode($raw, true);

        curl_close($ch);
        return $emailData;
    }
}
