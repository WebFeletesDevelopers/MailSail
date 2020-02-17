<?php

namespace WebFeletesDevelopers\MailSail\Domain\EmailServer;

use WebFeletesDevelopers\MailSail\Domain\SMTPLoginData\SMTPLoginData;

/**
 * Class BaseEmailServer.
 *
 * This interface contains the main method declarations for an EmailServer.
 *
 * @package WebFeletesDevelopers\MailSail\Domain\EmailServer
 * @author WebFeletesDevelopers
 */
interface EmailServerInterface
{
    /**
     * @return bool
     */
    public function debug(): bool;

    /**
     * @return string
     */
    public function host(): string;

    /**
     * @return int
     */
    public function port(): int;

    /**
     * @return SMTPLoginData
     */
    public function loginData(): SMTPLoginData;

    /**
     * @return string|null
     */
    public function encryption(): ?string;
}
