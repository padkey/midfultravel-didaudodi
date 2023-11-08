<?php

namespace DDDD\Subscription\Services;

use Illuminate\Http\Request;

interface ISubmitProductSubscriptionService
{
    public function submitData(Request $request);
}
