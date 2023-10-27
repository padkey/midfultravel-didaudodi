<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DDDD\Partnership\Models\PartnershipModel;
use DDDD\Partnership\Models\PartnershipBranch;
class PartnershipController extends Controller
{
    //
    public function partnershipBranchDetails($url){
        $locale_code =   config('app.locale');
        $partnershipBranch =  PartnershipBranch::where('locale_code',$locale_code)->where('url',$url)->first();
        return view('pages.partnership.partnershipBranchDetails')->with(compact('partnershipBranch'));
    }
}
