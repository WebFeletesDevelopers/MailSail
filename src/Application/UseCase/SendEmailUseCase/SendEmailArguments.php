<?php

namespace WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase;

use WebFeletesDevelopers\MailSail\Domain\EmailServer\EmailServerInterface;

/**
 * Class SendEmailArguments.
 *
 * This class will contain the Email data and an EmailServer.
 *
 * @package WebFeletesDevelopers\MailSail\Application\UseCase\SendEmailUseCase
 * @author WebFeletesDevelopers
 */
class SendEmailArguments
{
    /** @var string */
    private string $from;

    /** @var string */
    private string $to;

    /** @var string */
    private string $subject;

    /** @var string */
    private string $body;

    /**
     * SendEmailArguments constructor.
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $body
     */
    public function __construct(
        string $from,
        string $to,
        string $subject,
        string $body
    ) {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function from(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function to(): string
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function subject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function body(): string
    {
        return $this->body;
    }
}
