<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;

class DetectLanguage
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
        
        $local = ($request->hasHeader('X-Localization')) ? $request->header('X-Localization') : 'id';
        
        if (!array_key_exists($local, app()->config->get('app.supported_languages'))) {
            return abort(403, 'Language not supported.');
        }

        app()->setLocale($local);
        return $next($request);
    }
}
