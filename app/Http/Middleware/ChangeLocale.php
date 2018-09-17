<?php

namespace App\Http\Middleware;

use Closure;
Use App;

class ChangeLocale
{
  /**
     * Allowed languages
     * @var array
     */
    protected $locales = ['en', 'pt_br'];

    /**
     * Handle an incoming request and change app locale.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->session()->get('locale');
        if (!empty($locale) && in_array($locale, $this->locales)) {
          App::setLocale($locale);
        }
        return $next($request);
    }
}
