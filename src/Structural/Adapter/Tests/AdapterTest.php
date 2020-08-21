<?php

declare(strict_types=1);

namespace Noitran\Patterns\Structural\Adapter\Tests;

use JoliCode\Slack\Api\Client;
use Noitran\Patterns\Structural\Adapter\EmailNotification;
use Noitran\Patterns\Structural\Adapter\SlackNotification;
use PHPUnit\Framework\TestCase;

class AdapterTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_initialize_adapter(): void
    {
        $emailNotification = new EmailNotification();
        self::assertTrue($emailNotification->send('title', 'message'));

        // $client = ClientFactory::create('xoxb-13079033064');
        $stubClient = $this->createMock(Client::class);

        $response = (new SlackNotification($stubClient))->send('title', 'message');

        self::assertTrue($response);
    }
}
