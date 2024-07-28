<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLastActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->user();
        if ($user) {
            $user->forceFill([ /* -we used forceFill here instead of fill cuz we didn't include the column in the fillable method in the users model, 
so with forcefill it will include it in the fillable.
-Carbon is php package for datetime, is a class with a method called now brings the time within user did anything in the app.
*/
                'last_active_at' => Carbon::now()
            ])->save();
        }
        return $next($request);
    }
}
