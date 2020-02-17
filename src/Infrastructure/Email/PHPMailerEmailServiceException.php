<?php

namespace WebFeletesDevelopers\MailSail\Infrastructure\Email;

use Exception;

/**
 * Class PHPMailerEmailServiceException
 * @package WebFeletesDevelopers\MailSail\Infrastructure\Email
 * @author WebFeletesDevelopers
 */
class PHPMailerEmailServiceException extends Exception
{
    private const FAILED_SEND_MESSAGE = 'The email failed to send. Error: %s';
    private const FAILED_SEND_MESSAGE_UNKNOWN = 'The email failed to send because of an unknown error.';

    /**
     * Called when any of the native PHPMailer functions failed.
     *
     * @param string $error PHPMailer native error description.
     * @return self
     */
    public static function fromFailedSendMessage(string $error): self
    {
        return new self(sprintf(self::FAILED_SEND_MESSAGE, $error));
    }

    /**
     * Called when the result of PHPMailer::send() is false.
     *
     * @return self
     */
    public static function fromFailedSendMessageUnknown(): self
    {
        return new self(self::FAILED_SEND_MESSAGE_UNKNOWN);
    }
}
