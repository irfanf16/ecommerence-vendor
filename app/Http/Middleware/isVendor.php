<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
class isVendor
{
    public function handle(Request $request, Closure $next)
    {
        // 2 IS THE user_role_id FOR VENDOR
        $user = $request->session()->get('user');
 
        if (!$user || !($user->role_id == 2)) {
            return response()->view('vendor.pages.401');
        }
        
        return $next($request);
    }
}