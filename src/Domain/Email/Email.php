<?php

namespace WebFeletesDevelopers\MailSail\Domain\Email;

/**
 * Class Email.
 *
 * This class represents an Email, having a from address, to address, a subject and the HTML-compatible body.
 *
 * @package WebFeletesDevelopers\MailSail\Domain\Email
 * @author WebFeletesDevelopers
 */
class Email
{
    /** @var EmailAddress */
    private EmailAddress $from;

    /** @var EmailAddress */
    private EmailAddress $to;

    // TODO: Tipar esto.
    /** @var string */
    private string $subject;

    // TODO: Tipar esto.
    /** @var string */
    private string $body;

    /**
     * Email constructor.
     * @param EmailAddress $from
     * @param EmailAddress $to
     * @param string $subject
     * @param string $body
     */
    public function __construct(
        EmailAddress $from,
        EmailAddress $to,
        string $subject,
        string $body
    ) {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * @return EmailAddress
     */
    public function from(): EmailAddress
    {
        return $this->from;
    }

    /**
     * @return EmailAddress
     */
    public function to(): EmailAddress
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
