<?php

namespace WebFeletesDevelopers\MailSail\Domain\Email;

/**
 * Class EmailAddress
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
     * @param string $emailAddress
     * @return static
     * @throws InvalidEmailAddressException
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
