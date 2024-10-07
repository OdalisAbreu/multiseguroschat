<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\BlockedClient;



class CheckBlocedNumber
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
        $phonenumber = $request->client; 
        $blocked = BlockedClient::where('phoneNumber', $phonenumber)->exists();

        if ($blocked) {
            
            return redirect()->route('blockedview'); 
        }

        return $next($request);
    }
}
