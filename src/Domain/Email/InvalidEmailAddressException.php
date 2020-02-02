<?php

namespace WebFeletesDevelopers\MailSail\Domain\Email;

use Exception;

/**
 * Class InvalidEmailAddressException
 * @package WebFeletesDevelopers\MailSail\Domain\Email
 * @author WebFeletesDevelopers
 */
class InvalidEmailAddressException extends Exception
{
    private const INVALID_EMAIL_FORMAT_MESSAGE = 'The email %s has an invalid format.';

    /**
     * @param string $email
     * @return static
     */
    public static function fromInvalidEmailFormat(string $email): self
    {
        return new self(
            sprintf(self::INVALID_EMAIL_FORMAT_MESSAGE, $email)
        );
    }
}