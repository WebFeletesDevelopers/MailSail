<?php

namespace WebFeletesDevelopers\MailSail\Domain\Email;

use WebFeletesDevelopers\MailSail\Domain\EmailServer\EmailServerInterface;

/**
 * Interface EmailServiceInterface
 * @package WebFeletesDevelopers\MailSail\Domain\Email
 * @author WebFeletesDevelopers
 */
interface EmailServiceInterface
{
    /**
     * @param EmailServerInterface $emailServer
     * @param Email $email
     * @return bool
     */
    public function send(
        EmailServerInterface $emailServer,
        Email $email
    ): bool;
}