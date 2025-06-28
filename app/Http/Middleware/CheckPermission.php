<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $action = $request->route()->getActionMethod();

        $map = [
            'create'  => 'add',
            'store'   => 'add',
            'edit'    => 'update',
            'update'  => 'update',
            'destroy' => 'delete',
            'index'   => 'view'
        ];

        if (isset($map[$action])) {
            $uri = $request->route()->uri();

            $prefix = explode('/', $uri)[0];

            $prefixSnake = str_replace('-', '_', $prefix);

            $permission = $map[$action] . '_' . $prefixSnake;

            if (\Illuminate\Support\Facades\Gate::denies($permission)) {
                $prefix = $prefix . '.index';
                $callbakRedirect = redirect()->route($prefix);

                if ($map[$action] == "view") {
                    $prefix = "/";
                    $callbakRedirect = redirect($prefix);
                }

                \RealRashid\SweetAlert\Facades\Alert::error('Akses Ditolak', 'Anda tidak memiliki hak akses!');
                return $callbakRedirect;
            }
        }

    return $next($request);
}

}
