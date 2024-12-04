<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckRole
{
    public function handle($request, Closure $next, ...$roleId)
    {
        $roleIds = ['SUPERADMIN' => 1, 'ADMINGEREJA' => 2];
        $allowedRoleIds = [];
    
        foreach ($roleId as $as) {
            if (isset($roleIds[$as])) {
                $allowedRoleIds[] = $roleIds[$as];
            }
        }
        $allowedRoleIds = array_unique($allowedRoleIds);
    
        if (Auth::check()) {
            if (in_array(Auth::user()->role_id, $allowedRoleIds)) {
                return $next($request);
            }
        }
    
        abort(403, 'Unauthorized access');
    }
    
}
