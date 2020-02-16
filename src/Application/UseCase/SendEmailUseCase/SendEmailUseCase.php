<?php

namespace WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase;

use Exception;
use WebFeletesDevelopers\MailSail\Domain\Email\Email;
use WebFeletesDevelopers\MailSail\Domain\Email\EmailAddress;
use WebFeletesDevelopers\MailSail\Domain\Email\EmailServiceInterface;

/**
 * Class SendEmailUseCase
 * @package WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase
 * @author WebFeletesDevelopers
 */
class SendEmailUseCase
{
    /** @var EmailServiceInterface */
    private EmailServiceInterface $mailer;

    /**
     * SendEmailUseCase constructor.
     * @param EmailServiceInterface $mailer
     */
    public function __construct(EmailServiceInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param SendEmailArguments $arguments
     * @return SendEmailResponse
     */
    public function handle(SendEmailArguments $arguments): SendEmailResponse
    {
        $response = new SendEmailResponse();
        try {
            $from = EmailAddress::fromEmailString($arguments->from());
            $to = EmailAddress::fromEmailString($arguments->to());
            $email = new Email(
                $from,
                $to,
                $arguments->subject(),
                $arguments->body()
            );

            $this->mailer->send(
                $arguments->mailServer(),
                $email
            );
        } catch (Exception $e) {
            $response->setError($e);
        }
        return $response;
    }
}
