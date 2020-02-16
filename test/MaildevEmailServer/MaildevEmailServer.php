<?php

namespace WebFeletesDevelopers\MailSail\Test\MaildevEmailServer;

use WebFeletesDevelopers\MailSail\Domain\EmailServer\BaseEmailServer;
use WebFeletesDevelopers\MailSail\Domain\SMTPLoginData\SMTPLoginData;

/**
 * Class MaildevEmailServer
 * @package WebFeletesDevelopers\MailSail\Domain\EmailServer
 * @author WebFeletesDevelopers
 * @todo Mover esta clase
 */
final class MaildevEmailServer extends BaseEmailServer
{
    private const MAILDEV_SMTP_HOST = 'maildev';
    private const MAILDEV_SMTP_PORT = 1025;
    private const MAILDEV_SMTP_USER = 'smtp_user';
    private const MAILDEV_SMTP_PASS = 'smtp_password';

    /**
     * MaildevEmailServer constructor.
     */
    public function __construct()
    {
        $loginData = new SMTPLoginData(self::MAILDEV_SMTP_USER, self::MAILDEV_SMTP_PASS);
        parent::__construct(
            self::MAILDEV_SMTP_HOST,
            self::MAILDEV_SMTP_PORT,
            $loginData,
            null,
            true
        );
    }
}
