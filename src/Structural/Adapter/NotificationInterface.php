<?php

declare(strict_types=1);

namespace Noitran\Patterns\Structural\Adapter;

interface NotificationInterface
{
    public function send(string $title, string $message);
}
