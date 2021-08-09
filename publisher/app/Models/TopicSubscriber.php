<?php

namespace App\Models;

class TopicSubscriber
{
    public function __construct(public string $topic, public string $url)
    {
    }
}
