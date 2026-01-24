<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    // Get locale from session, default to 'id' (Indonesian)
    $locale = session()->get('locale', 'id');
    
    // Locale is enabled and allowed to be changed
    if (in_array($locale, ['en', 'id'])) {
      app()->setLocale($locale);
    } else {
      // Fallback to Indonesian if invalid locale
      app()->setLocale('id');
    }

    return $next($request);
  }
}
