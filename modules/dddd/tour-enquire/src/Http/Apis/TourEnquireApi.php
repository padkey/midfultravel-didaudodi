<?php

namespace DDDD\TourEnquire\Http\Apis;

use DDDD\TourEnquire\Services\ISubmitTourEnquireService;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class TourEnquireApi extends Controller
{

    /**
     * @var ISubmitTourEnquireService
     */
    protected ISubmitTourEnquireService $TourEnquireService;

    /**
     * @param ISubmitTourEnquireService $TourEnquireService
     */
    public function __construct(ISubmitTourEnquireService $TourEnquireService)
    {
        $this->TourEnquireService = $TourEnquireService;
    }

    public function submit(Request $request)//: Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        try {
            Log::info('Data TourEnquire: '. json_encode($request->all()));
            $this->TourEnquireService->submitData($request);
        } catch (Exception $exception) {
            return response("Save data error. ". $exception->getMessage(), 500);
        }
        return response("Save data success.");
    }
}
