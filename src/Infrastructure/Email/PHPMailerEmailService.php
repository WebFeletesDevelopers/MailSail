<?php

namespace WebFeletesDevelopers\MailSail\Infrastructure\Email;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Psr\Log\LoggerInterface;
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

    /** @var LoggerInterface */
    private LoggerInterface $logger;

    /**
     * PHPMailerEmailService constructor.
     * @param PHPMailer $mailer
     * @param LoggerInterface $logger
     */
    public function __construct(PHPMailer $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /**
     * Prepare an Email to be sent using an EmailServerInterface credentials, using native PHPMailer functions.
     *
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
        if ($result === false) {
            throw PHPMailerEmailServiceException::fromFailedSendMessageUnknown();
        }
        return $result;
    }

    /**
     * Set the PHPMailer login data (user, password, port, SMTP, encryption, debug if needed...).
     *
     * @param EmailServerInterface $emailServer
     * @param PHPMailer $mailer
     */
    private function login(
        EmailServerInterface $emailServer,
        PHPMailer $mailer
    ): void {
        $mailer->isSMTP();

        if ($emailServer->debug()) {
            $mailer->SMTPDebug = SMTP::DEBUG_SERVER;
            $mailer->Debugoutput = $this->logger;
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
     * Add the body, subject, sender and recipient.
     *
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
