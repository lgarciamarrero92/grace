<?php

namespace App\Http\Middleware;
use Inertia\Inertia;
class ShareInertiaCustomData
{
    public function handle($request,$next){
        Inertia::share([
            'formFields' => config('constants.formFields')
        ]);
        return $next($request);
    }
}
