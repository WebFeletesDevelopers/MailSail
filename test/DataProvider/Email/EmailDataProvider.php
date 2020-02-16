<?php

namespace WebFeletesDevelopers\MailSail\Test\DataProvider\Email;

use WebFeletesDevelopers\MailSail\Domain\Email\Email;
use WebFeletesDevelopers\MailSail\Domain\Email\EmailAddress;
use WebFeletesDevelopers\MailSail\Domain\Email\InvalidEmailAddressException;

/**
 * Class EmailDataProvider
 * @package WebFeletesDevelopers\MailSail\Test\DataProvider\Email
 * @author WebFeletesDevelopers
 */
class EmailDataProvider
{
    public const EMAIL_FROM = 'from@email.com';
    public const EMAIL_TO = 'to@email.com';
    public const EMAIL_SUBJECT = 'Subject';
    public const EMAIL_BODY = 'The body';

    /**
     * @param string|null $from
     * @param string|null $to
     * @param string|null $subject
     * @param string|null $body
     * @return Email
     * @throws InvalidEmailAddressException
     */
    public static function getOne(
        ?string $from = null,
        ?string $to = null,
        ?string $subject = null,
        ?string $body = null
    ): Email {
        return new Email(
            EmailAddress::fromEmailString($from ?? self::EMAIL_FROM),
            EmailAddress::fromEmailString($to ?? self::EMAIL_TO),
            $subject ?? self::EMAIL_SUBJECT,
            $body ?? self::EMAIL_BODY
        );
    }
}
