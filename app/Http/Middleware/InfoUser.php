<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InfoUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $InfoUser = Auth::user();
        // dd($InfoUser->name);
        $request->infoUser = $InfoUser;
       
        return $next($request);
    }
}
