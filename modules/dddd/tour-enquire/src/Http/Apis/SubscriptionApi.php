<?php

namespace DDDD\Subscription\Http\Apis;

use DDDD\Subscription\Services\ISubmitSubscriptionService;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class SubscriptionApi extends Controller
{

    /**
     * @var ISubmitSubscriptionService
     */
    protected ISubmitSubscriptionService $subscriptionService;

    /**
     * @param ISubmitSubscriptionService $subscriptionService
     */
    public function __construct(ISubmitSubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function submit(Request $request)//: Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        try {
            Log::info('Data subscription: '. json_encode($request->all()));
            $this->subscriptionService->submitData($request);
        } catch (Exception $exception) {
            return response("Save data error. ". $exception->getMessage(), 500);
        }
        return response("Save data success.");
    }
}
