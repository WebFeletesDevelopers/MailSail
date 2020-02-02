<?php

namespace WebFeletesDevelopers\MailSail\Domain\EmailServer;

/**
 * Class BaseEmailServer
 * @package WebFeletesDevelopers\MailSail\Domain\EmailServer
 * @author WebFeletesDevelopers
 */
abstract class BaseEmailServer
{
    /** @var bool */
    protected bool $debug;

    /** @var string */
    protected string $host;

    /** @var int */
    protected int $port;

    /** @var string */
    protected string $login;

    /** @var string */
    protected string $password;
}