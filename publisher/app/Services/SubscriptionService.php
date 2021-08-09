<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

use App\Models\TopicSubscriber;
use App\Models\TopicSubscription;

class SubscriptionService
{
    private $subscriptionKey = 'subscriptions';
    private $cacheTTLInSeconds = 1000;

    public function subscribe(TopicSubscriber $topicSubscriber)
    {
        $topicSubscription = $this->getTopicSubscription($topicSubscriber->topic);
        
        if ($topicSubscription->addSubscriber($topicSubscriber->url)) {
            $this->saveTopicSubscription($topicSubscription);
        }
    }

    public function getTopicSubscription(string $topic): TopicSubscription
    {
        $subscriptions = $this->getSubscriptions();

        $topicSubscriptions = array_key_exists($topic, $subscriptions) ? $subscriptions[$topic] : [];

        return new TopicSubscription($topic, $topicSubscriptions);
    }

    private function saveTopicSubscription(TopicSubscription $topicSubscription)
    {
        $subscriptions = $this->getSubscriptions();

        $subscriptions[$topicSubscription->topic] = $topicSubscription->urls;

        Cache::put($this->subscriptionKey, $subscriptions, $this->cacheTTLInSeconds);
    }

    private function getSubscriptions(): array
    {
        $subscriptions = Cache::get($this->subscriptionKey, []);

        return $subscriptions;
    }
}
