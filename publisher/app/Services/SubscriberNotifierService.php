<?php

namespace App\Services;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Models\TopicSubscription;

class SubscriberNotifierService
{
    public function notify(TopicSubscription $subscription, array $data)
    {
        $responses = Http::pool(fn (Pool $pool) => $this->createRequests($pool, $subscription, $data));

        return $this->getNotificationSummary($responses, $subscription->urls);
    }

    private function createRequests(Pool $pool, TopicSubscription $subscription, $data)
    {
        return array_map(
            fn ($url) =>
            $pool->post($url, $this->createPayload($subscription->topic, $data)),
            $subscription->urls
        );
    }

    private function createPayload(string $topic, array $data)
    {
        return compact('topic', 'data');
    }

    private function getNotificationSummary(array $responses, array $urls)
    {
        $notificationSummary = array_map(fn ($response, $index) => [
            'url' => $urls[$index],
            'status' => $response instanceof \Exception ? 'Failed' : ($response->successful() ? 'Success' : 'Failed'),
        ], $responses, array_keys($urls));

        Log::info('Notification summary', $notificationSummary);

        return $notificationSummary;
    }
}
