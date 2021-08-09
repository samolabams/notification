<?php

namespace App\Http\Controllers\Publish;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SubscriptionService;
use App\Services\SubscriberNotifierService;

class PublishController extends Controller
{
    private $subscriptionService;
    private $subscriberNotifierService;

    public function __construct(SubscriptionService $subscriptionService, SubscriberNotifierService $subscriberNotifierService)
    {
        $this->subscriptionService = $subscriptionService;
        $this->subscriberNotifierService = $subscriberNotifierService;
    }

    public function create(Request $request, string $topic)
    {
        $data = $request->post();

        $subscription = $this->subscriptionService->getTopicSubscription($topic);

        $summary = $this->subscriberNotifierService->notify($subscription, $data);

        return response()->json(['message' => 'Notification Status', 'data' => $summary], 200, [], JSON_UNESCAPED_SLASHES);
    }
}
