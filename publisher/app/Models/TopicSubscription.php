<?php

namespace App\Models;

class TopicSubscription
{
    public function __construct(public string $topic, public array $urls)
    {
    }

    public function addSubscriber(string $url): bool
    {
        if (in_array($url, $this->urls) === false) {
            array_push($this->urls, $url);

            return true;
        }

        return false;
    }
}
