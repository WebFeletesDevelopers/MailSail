<?php

namespace WebFeletesDevelopers\MailSail\Infrastructure\Email;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use WebFeletesDevelopers\MailSail\Domain\Email\Email;
use WebFeletesDevelopers\MailSail\Domain\Email\EmailServiceInterface;
use WebFeletesDevelopers\MailSail\Domain\EmailServer\EmailServerInterface;

/**
 * Class PHPMailerEmailService
 * @package WebFeletesDevelopers\MailSail\Infrastructure\Email
 * @author WebFeletesDevelopers
 */
class PHPMailerEmailService implements EmailServiceInterface
{
    /** @var PHPMailer */
    private PHPMailer $mailer;

    /**
     * PHPMailerEmailService constructor.
     * @param PHPMailer $mailer
     */
    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param EmailServerInterface $emailServer
     * @param Email $email
     * @return bool
     * @throws PHPMailerEmailServiceException
     */
    public function send(
        EmailServerInterface $emailServer,
        Email $email
    ): bool {
        try {
            $this->login($emailServer, $this->mailer);
            $this->prepareMail($email, $this->mailer);
            $result = $this->mailer->send();
        } catch (Exception $e) {
            throw PHPMailerEmailServiceException::fromFailedSendMessage($this->mailer->ErrorInfo);
        }
        if (! $result) {
            throw PHPMailerEmailServiceException::fromFailedSendMessageUnknown();
        }
        return true;
    }

    /**
     * @param EmailServerInterface $emailServer
     * @param PHPMailer $mailer
     */
    private function login(
        EmailServerInterface $emailServer,
        PHPMailer $mailer
    ): void {
        $mailer->isSMTP();

        if ($emailServer->debug()) {
            // TODO: Sacar la salida a un logger.
            $mailer->SMTPDebug = SMTP::DEBUG_SERVER;
        }

        $mailer->Host = $emailServer->host();
        $mailer->Port = $emailServer->port();
        $mailer->SMTPAuth = true;
        $mailer->Username = $emailServer->loginData()->user();
        $mailer->Password = $emailServer->loginData()->password();

        if ($encryption = $emailServer->encryption()) {
            $mailer->SMTPSecure = $encryption;
        }
    }

    /**
     * @param Email $email
     * @param PHPMailer $mailer
     * @throws Exception
     */
    private function prepareMail(
        Email $email,
        PHPMailer $mailer
    ): void {
        $mailer->setFrom($email->from()->address());
        $mailer->addAddress($email->to()->address());
        $mailer->Subject = $email->subject();
        $mailer->msgHTML($email->body());
    }
}