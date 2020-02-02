<?php

namespace WebFeletesDevelopers\MailSail\Domain\SMTPLoginData;

/**
 * Class LoginData
 * @package WebFeletesDevelopers\MailSail\Domain\LoginData
 * @author WebFeletesDevelopers
 */
class SMTPLoginData
{
    /** @var string */
    private string $user;

    /** @var string */
    private string $password;

    /**
     * LoginData constructor.
     * @param string $user
     * @param string $password
     */
    public function __construct(
        string $user,
        string $password
    ) {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function user(): string
    {
        return $this->user;
    }

    public function password(): string
    {
        return $this->password;
    }
}