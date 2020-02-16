# MailSail

Simple to use email library.

## Code examples

If you use a supported email provider, you will just need your login data (SMTP username and password)

We currently support these Email providers:
- Google Mail


To send an email on an unsupported provider, you will need:
- SMTP server address and port.
- Your login data.
- The encryption.

You can use the provided constants in BaseEmailServer class (ENCRYPTION_TLS or ENCRYPTION_SSL) to set the encryption.

We have included, too, a console basic logger, but you can use monolog or any PSR-3 compliant logger of your choice.

Sending an email example:
```php
$mailServer = new CustomEmailServer(
    'smtp.yourprovider.com',
    portNumberAsInt,
    new SMTPLoginData(
        'smtp@user.com',
        'smtpPassword'
    ),
    encryption,
    isDebug
);

$arguments = new SendEmailArguments(
    'from@server.com',
    'to@server.com',
    'subject',
    '<p>HTML-Compatible body</p>',
    $mailServer
);

$useCase = new SendEmailUseCase(
    new PHPMailerEmailService(
        new PHPMailer(),
        new ConsoleLogger()
    )
);

$useCase->handle($arguments);

// TADA! Your email has been sent.
```
