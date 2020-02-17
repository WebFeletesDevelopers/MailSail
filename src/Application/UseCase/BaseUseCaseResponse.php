<?php

namespace WebFeletesDevelopers\MailSail\Application\UseCase;

use Exception;

/**
 * Class BaseUseCaseResponse.
 *
 * This class contains the common UseCaseResponse fields.
 *
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
     * Returns true if there was no error running the use case.
     *
     * @return bool
     */
    public function success(): bool
    {
        return $this->success;
    }

    /**
     * Mark the use case as failed, and set the error to an Exception.
     *
     * @param Exception $e
     * @return void
     */
    public function setError(Exception $e): void
    {
        $this->success = false;
        $this->error = $e;
    }

    /**
     * Return an Exception if the use case failed, or null if it succeeded.
     *
     * @return Exception|null
     */
    public function error(): ?Exception
    {
        return $this->error;
    }
}
