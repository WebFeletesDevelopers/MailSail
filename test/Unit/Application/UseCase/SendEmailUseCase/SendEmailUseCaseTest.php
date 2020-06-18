<?php

namespace WebFeletesDevelopers\MailSail\Test\Unit\Application\UseCase\SendEmailUseCase;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase\SendEmailArguments;
use WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase\SendEmailUseCase;
use WebFeletesDevelopers\MailSail\Domain\Email\Email;
use WebFeletesDevelopers\MailSail\Domain\Email\EmailServiceInterface;
use WebFeletesDevelopers\MailSail\Domain\EmailServer\EmailServerInterface;
use WebFeletesDevelopers\MailSail\Infrastructure\Email\PHPMailerEmailServiceException;
use WebFeletesDevelopers\MailSail\Test\DataProvider\Email\EmailDataProvider;

/**
 * Class SendEmailUseCaseTest
 * @package WebFeletesDevelopers\MailSail\Test\Unit\Application\UseCase\SendEmailUseCase
 * @author WebFeletesDevelopers
 */
class SendEmailUseCaseTest extends TestCase
{
    protected function tearDown(): void
    {
        m::close();
    }

    /**
     * @test
     */
    public function handleHappyPath(): void
    {
        $mailCheck = static function (Email $email) {
            return $email->from()->address() === EmailDataProvider::EMAIL_FROM
                && $email->to()->address() === EmailDataProvider::EMAIL_TO
                && $email->subject() === EmailDataProvider::EMAIL_SUBJECT
                && $email->body() === EmailDataProvider::EMAIL_BODY;
        };

        $emailService = m::mock(EmailServiceInterface::class);
        $emailService->shouldReceive('send')->with(m::on($mailCheck))->andReturn('true');

        $arguments = $this->getArguments();

        $useCase = new SendEmailUseCase($emailService);

        $response = $useCase->handle($arguments);

        $this->assertTrue($response->success());
        $this->assertEmpty($response->error());
    }

    /**
     * @test
     */
    public function handleMailServiceException(): void
    {
        $emailServer = m::mock(EmailServerInterface::class);

        $emailService = m::mock(EmailServiceInterface::class);
        $emailService->shouldReceive('send')
            ->andThrow(PHPMailerEmailServiceException::class);

        $arguments = $this->getArguments();

        $useCase = new SendEmailUseCase($emailService);

        $response = $useCase->handle($arguments);

        $this->assertFalse($response->success());
        $this->assertNotEmpty($response->error());
        $this->assertInstanceOf(
            PHPMailerEmailServiceException::class,
            $response->error()
        );
    }

    /**
     * @return SendEmailArguments
     */
    private function getArguments(): SendEmailArguments
    {
        return new SendEmailArguments(
            EmailDataProvider::EMAIL_FROM,
            EmailDataProvider::EMAIL_TO,
            EmailDataProvider::EMAIL_SUBJECT,
            EmailDataProvider::EMAIL_BODY
        );
    }
}
