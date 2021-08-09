<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeTopicRequest;
use App\Services\SubscriptionService;
use App\Http\Resources\SubscribeResource;
use App\Models\TopicSubscriber;

class SubscribeController extends Controller
{
    private $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function create(SubscribeTopicRequest $request, string $topic)
    {
        $topicSubscriber = new TopicSubscriber($topic, $request->url);

        $this->subscriptionService->subscribe($topicSubscriber);

        return (new SubscribeResource($topicSubscriber));
    }
}
