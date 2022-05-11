<?php

namespace App\Http\Middleware;

use App\Models\Options;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale');
        if ($locale) {
            $lang = $locale;
        } elseif (auth()->id()) {
            $options = Options::firstOrCreate(['user_id' => auth()->id()]);
            $lang = $options->lang;
        } else {
            $lang = 'en';
        }

        App::setLocale($lang);
        return $next($request);
    }
}
