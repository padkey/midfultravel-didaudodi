<?php

namespace DDDD\Subscription\Services;

use Illuminate\Http\Request;

interface ISubmitSubscriptionService
{
    public function submitData(Request $request);
}
