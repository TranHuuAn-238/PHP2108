<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAgeWatchFilm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $params =null)
    {
        // $params: biến đại diện cho tham số truyền vào middleware
        $age = $request->age;
        if($age < 18 && $params !== 'admin') {
            return redirect()->route('do-not-watch-film');
        }
        return $next($request);
    }
}
