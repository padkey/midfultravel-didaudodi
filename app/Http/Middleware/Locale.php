<?php

namespace App\Http\Middleware;

use Closure;
use DDDD\Banner\Models\Banner;
use DDDD\Blog\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DDDD\Partnership\Models\PartnershipModel;
class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $language = \Session::get('website_language', config('app.locale'));
        // Lấy dữ liệu lưu trong Session, không có thì trả về default lấy trong config

        config(['app.locale' => $language]);
        // Chuyển ứng dụng sang ngôn ngữ được chọn
        $categoryPost = BlogCategory::where('url','!=','show-home-center')
            ->where('locale_code',$language)->where('url','!=','show-home-right')
            /*->where('url','!=','mindfulness-practice')*/
            ->where('url','!=','show-home-left')->get();
        $logoWhite = Banner::with('items')->where('uuid','logo_white')->first();
        $logoBlack = Banner::with('items')->where('uuid','logo_black')->first();
        $allPartnership = PartnershipModel::with('partnershipBranch')->where('locale_code',$language)->get();
        View::share(compact('categoryPost','logoWhite','logoBlack','allPartnership'));

        return $next($request);
    }
}
