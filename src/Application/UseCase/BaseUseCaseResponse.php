<?php

namespace WebFeletesDevelopers\MailSail\Application\UseCase;

use Exception;

/**
 * Class BaseUseCaseResponse
 * @package WebFeletesDevelopers\MailSail\Application\UseCase
 * @author WebFeletesDevelopers
 */
class BaseUseCaseResponse
{
    /** @var Exception|null */
    protected ?Exception $error;

    /** @var bool */
    protected bool $success;

    /**
     * BaseUseCaseResponse constructor.
     */
    public function __construct()
    {
        $this->success = true;
        $this->error = null;
    }

    /**
     * @return bool
     */
    public function success(): bool
    {
        return $this->success;
    }

    /**
     * @param Exception $e
     * @return void
     */
    public function setError(Exception $e): void
    {
        $this->success = false;
        $this->error = $e;
    }

    /**
     * @return Exception|null
     */
    public function error(): ?Exception
    {
        return $this->error;
    }
}
