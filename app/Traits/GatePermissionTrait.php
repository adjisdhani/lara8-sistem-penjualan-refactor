<?php

namespace App\Traits;

use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

trait GatePermissionTrait
{
    public function applyGatePermissions(string $prefix)
    {
        $aksesMap = [
            'create'  => "add_{$prefix}",
            'store'   => "add_{$prefix}",
            'edit'    => "update_{$prefix}",
            'update'  => "update_{$prefix}",
            'destroy' => "delete_{$prefix}",
        ];

        foreach ($aksesMap as $method => $gate) {
            $this->middleware(function ($request, $next) use ($gate, $prefix) {
                $prefix = str_replace("_", "-", $prefix);

                if (Gate::denies($gate)) {
                    Alert::error('Akses Ditolak', 'Anda tidak memiliki hak akses!');
                    return redirect()->route("{$prefix}.index");
                }
                
                return $next($request);
            })->only($method);
        }
    }
}