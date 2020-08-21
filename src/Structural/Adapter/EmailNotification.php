<?php

declare(strict_types=1);

namespace Noitran\Patterns\Structural\Adapter;

class EmailNotification implements NotificationInterface
{
    public function send(string $title, string $message): bool
    {
        // Email sending logic...

        return true;
    }
}
