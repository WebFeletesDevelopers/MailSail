<?php

namespace WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase;

use Exception;
use WebFeletesDevelopers\MailSail\Domain\Email\Email;
use WebFeletesDevelopers\MailSail\Domain\Email\EmailAddress;
use WebFeletesDevelopers\MailSail\Domain\Email\EmailServiceInterface;

/**
 * Class SendEmailUseCase.
 *
 * This class will handle a SendEmailArguments, trying to send an Email using the provided EmailService
 * over an EmailServer.
 *
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
     * Create two addresses, an Email, then use an EmailServiceInterface to send that Email.
     * This will return a SendEmailResponse.
     *
     * @see $mailer
     *
     * @param SendEmailArguments $arguments Class that will contain the Email data.
     * @return SendEmailResponse Response that will be success if the Email is sent with the EmailService
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
                $email
            );
        } catch (Exception $e) {
            $response->setError($e);
        }
        return $response;
    }
}
