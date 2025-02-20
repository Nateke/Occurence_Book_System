<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
//    public function handle(Request $request, Closure $next): Response
//    {
  public function handle($request, Closure $next)
  {
    info('CheckUserStatus middleware is executed.');
    if (!Auth::check()) {
      return redirect()->route('login');
    }
    $user = Auth::user();

    if ($user && $user->status === 'active') {
      return $next($request);
    }

    return redirect()->route('login')->withErrors(['status' => 'Unauthorized or inactive account.']);
  }
}
