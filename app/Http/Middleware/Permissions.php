<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Migration_role;
use App\Models\Migration;
use App\Models\Role;
use Auth;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$model,$role)
    {

        $path = "\App\Models\\".$model;
        $modelName = new $path();
        $tableName = $modelName->getTable();
        $admin_roles = Migration_role::where('permission_id',Auth::guard('admin')->user()->permission_id)->get();


        foreach($admin_roles as $admin_role){
            $migration = Migration::find($admin_role->migration_id);
            $mainrole = Role::find($admin_role->role_id);
            if ($migration->name == $tableName && $mainrole->roleName == $role) {
                // code...
                return $next($request);
                break;
            }
        }

        session()->flash('warning','dont have permissions');
        return back();

    }
}
