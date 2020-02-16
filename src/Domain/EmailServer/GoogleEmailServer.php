<?php

namespace WebFeletesDevelopers\MailSail\Domain\EmailServer;

use WebFeletesDevelopers\MailSail\Domain\SMTPLoginData\SMTPLoginData;

/**
 * Class GoogleEmailServer
 * @package WebFeletesDevelopers\MailSail\Domain\EmailServer
 * @author WebFeletesDevelopers
 */
final class GoogleEmailServer extends BaseEmailServer
{
    private const GOOGLE_SMTP_HOST = 'smtp.gmail.com';
    private const GOOGLE_SMTP_PORT = 587;

    /**
     * GoogleEmailServer constructor.
     * @param SMTPLoginData $loginData
     */
    public function __construct(
        SMTPLoginData $loginData
    ) {
        parent::__construct(
            self::GOOGLE_SMTP_HOST,
            self::GOOGLE_SMTP_PORT,
            $loginData,
            self::ENCRYPTION_TLS
        );
    }
}
