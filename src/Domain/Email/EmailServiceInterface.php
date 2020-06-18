<?php

namespace WebFeletesDevelopers\MailSail\Domain\Email;

use WebFeletesDevelopers\MailSail\Domain\EmailServer\EmailServerInterface;

/**
 * Interface EmailServiceInterface.
 *
 * Every email service will inherit this interface to be able to send messages.
 *
 * @package WebFeletesDevelopers\MailSail\Domain\Email
 * @author WebFeletesDevelopers
 */
interface EmailServiceInterface
{
    /**
     * Send an Email over a class implementing EmailServerInterface
     *
     * @param Email $email
     * @return bool
     */
    public function send(Email $email): bool;
}
