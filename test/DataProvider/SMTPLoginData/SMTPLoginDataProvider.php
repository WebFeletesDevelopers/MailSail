<?php

namespace WebFeletesDevelopers\MailSail\Test\DataProvider\SMTPLoginData;

use WebFeletesDevelopers\MailSail\Domain\SMTPLoginData\SMTPLoginData;

/**
 * Class SMTPLoginDataProvider
 * @package WebFeletesDevelopers\MailSail\Test\DataProvider\SMTPLoginData
 * @author WebFeletesDevelopers
 */
class SMTPLoginDataProvider
{
    public const LOGIN_USER = 'user@oumama.com';
    public const LOGIN_PASSWORD= 'I am very secure!!';

    /**
     * @param string|null $user
     * @param string|null $password
     * @return SMTPLoginData
     */
    public static function getSMTPLoginData(
        ?string $user = null,
        ?string $password = null
    ): SMTPLoginData {
        return new SMTPLoginData(
            $user ?? self::LOGIN_USER,
            $password ?? self::LOGIN_PASSWORD
        );
    }
}
