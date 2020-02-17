<?php

namespace WebFeletesDevelopers\MailSail\Domain\Email;

/**
 * Class EmailAddress.
 *
 * This class represents an Email address.
 *
 * @package WebFeletesDevelopers\MailSail\Domain\Email
 * @author WebFeletesDevelopers
 */
class EmailAddress
{
    /** @var string  */
    private string $address;

    /**
     * EmailAddress constructor.
     * @param string $address
     */
    private function __construct(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function address(): string
    {
        return $this->address;
    }

    /**
     * Create a new EmailAddress from a string. The string will be checked for validity.
     *
     * @param string $emailAddress
     * @return self
     * @throws InvalidEmailAddressException if the string is not a valid email address.
     */
    public static function fromEmailString(string $emailAddress): self
    {
        $emailAddress = trim($emailAddress);
        if (! filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailAddressException::fromInvalidEmailFormat($emailAddress);
        }

        return new self($emailAddress);
    }
}
