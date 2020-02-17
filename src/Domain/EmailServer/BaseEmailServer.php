<?php

namespace WebFeletesDevelopers\MailSail\Domain\EmailServer;

use WebFeletesDevelopers\MailSail\Domain\SMTPLoginData\SMTPLoginData;

/**
 * Class BaseEmailServer.
 *
 * Abstract class representing an EmailServer that will contain the host, port and SMTPLoginData,
 * and might contain an encryption method.
 *
 * @package WebFeletesDevelopers\MailSail\Domain\EmailServer
 * @author WebFeletesDevelopers
 */
abstract class BaseEmailServer implements EmailServerInterface
{
    protected const ENCRYPTION_TLS = 'tls';
    protected const ENCRYPTION_SSL = 'ssl';

    /** @var bool */
    protected bool $debug;

    /** @var string */
    protected string $host;

    /** @var int */
    protected int $port;

    /** @var SMTPLoginData */
    protected SMTPLoginData $loginData;

    /** @var string|null */
    private ?string $encryption;

    /**
     * BaseEmailServer constructor.
     * @param string $host
     * @param int $port
     * @param SMTPLoginData $loginData
     * @param string|null $encryption
     * @param bool $debug
     */
    public function __construct(
        string $host,
        int $port,
        SMTPLoginData $loginData,
        ?string $encryption,
        bool $debug = false
    ) {
        $this->host = $host;
        $this->port = $port;
        $this->loginData = $loginData;
        $this->encryption = $encryption;
        $this->debug = $debug;
    }

    /**
     * @return bool
     */
    public function debug(): bool
    {
        return $this->debug;
    }

    /**
     * @return string
     */
    public function host(): string
    {
        return $this->host;
    }

    /**
     * @return int
     */
    public function port(): int
    {
        return $this->port;
    }

    /**
     * @return SMTPLoginData
     */
    public function loginData(): SMTPLoginData
    {
        return $this->loginData;
    }

    /**
     * @return string|null
     */
    public function encryption(): ?string
    {
        return $this->encryption;
    }
}
