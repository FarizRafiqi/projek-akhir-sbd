<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuthGates
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
        // Cek apakah ada user yang terautentikasi, jika ada maka atur hak aksesnya
        if($request->user()){
            $roles = Role::with('permissions')->get();
            $permissions = [];
            foreach($roles as $role){
                //Siapa saja yang memiliki hak akses (permission) ini
                foreach($role->permissions as $permission){
                    $permissions[$permission->title][] = $role->id; //['payment_edit' => [1, 3]]
                }
            }

            foreach ($permissions as $title => $role) {
                /**
                 * cek apakah user yang bersangkutan memiliki hak akses tertentu,
                 * jika punya maka definisikan gatenya
                 */
                Gate::define($title, function($user) use ($role){
                    return in_array($user->role->id, $role);
                });
            }
        }
        return $next($request);
    }
}
