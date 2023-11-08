<?php

namespace DDDD\TourEnquire\Services;

use Illuminate\Http\Request;

interface ISubmitTourEnquireService
{
    public function submitData(Request $request);
}
