<?php

namespace WebFeletesDevelopers\MailSail\Test\Unit\Domain\Email;

use Exception;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use WebFeletesDevelopers\MailSail\Domain\Email\EmailAddress;
use WebFeletesDevelopers\MailSail\Domain\Email\InvalidEmailAddressException;

/**
 * Class EmailTest
 * @package WebFeletesDevelopers\MailSail\Test\Domain\Email
 * @author WebFeletesDevelopers
 */
class EmailTest extends TestCase
{
    protected function tearDown(): void
    {
        m::close();
    }

    /**
     * @test
     * @dataProvider emailAddressProvider
     */
    public function itShouldProcessEmailAddresses(
        string $email,
        $expected
    ): void {
        if ($expected instanceof Exception) {
            $this->expectException(get_class($expected));
        }
        $address = EmailAddress::fromEmailString($email);

        $this->assertSame(
            $expected,
            $address->address()
        );
    }

    public function emailAddressProvider(): array
    {
        return [
            ['desarrollo@feletes.es', 'desarrollo@feletes.es'],
            ['iam@invalid', new InvalidEmailAddressException()],
            ['metoo', new InvalidEmailAddressException()],
            [' iamvalid@trim.com ', 'iamvalid@trim.com'],
            ['', new InvalidEmailAddressException()],
        ];
    }

}
