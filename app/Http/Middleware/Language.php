<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;
use Config;
use Carbon\Carbon;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::has('locale')){
            $locale = Session::get('locale');
        }
        else{
            $locale = env('DEFAULT_LANGUAGE','en');
        }

        App::setLocale($locale);
        $request->session()->put('locale', $locale);
        $langcode = Session::has('langcode') ? Session::get('langcode') : 'en';
        Carbon::setLocale($langcode);

        return $next($request);
    }
}
