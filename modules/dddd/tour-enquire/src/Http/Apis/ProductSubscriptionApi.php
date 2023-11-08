<?php

namespace DDDD\Subscription\Http\Apis;

use DDDD\Subscription\Services\ISubmitProductSubscriptionService;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ProductSubscriptionApi extends Controller
{

    /**
     * @var ISubmitProductSubscriptionService
     */
    protected ISubmitProductSubscriptionService $productSubscriptionService;

    /**
     * @param ISubmitProductSubscriptionService $productSubscriptionService
     */
    public function __construct(ISubmitProductSubscriptionService $productSubscriptionService)
    {
        $this->productSubscriptionService = $productSubscriptionService;
    }

    public function submit(Request $request)//: Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        try {
            Log::info('Data product subscription: '. json_encode($request->all()));
            $this->productSubscriptionService->submitData($request);
        } catch (Exception $exception) {
            return response("Save data error. ". $exception->getMessage(), 500);
        }
        return response("Save data success.");
    }
}
