<?php

namespace App\Http\Middleware;

use Closure;

class Permissions
{

    public function handle($request, Closure $next,...$permissons)
    { 
        if(!auth()->user())
        {
            return response()->json(['message' => 'Access Denied'],403);
        }

        foreach ($permissons as $permisson)
        {
            try
            {
                if( !auth()->user()->hasRole('admin') && !auth()->user()->hasPermissionTo($permisson,'web'))
                {
                    return response()->json(['message' => auth()->user()->getAllPermissions()],403);
                }
            }
            catch(\Exception $e)
            {
                return response()->json(['message' => 'Access Denied'],403);
            }
        }

        return $next($request);
    }
}
