<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait AksesMenuTrait {
    public function settingAksesMenu($keyRoute)
    {
        $data = DB::table('menus AS a')
                    ->selectRaw('
                        a.id AS MenuID,
                        GROUP_CONCAT(b.MenusActionID SEPARATOR ",") AS MenuActionID,
                        GROUP_CONCAT(c.key SEPARATOR ",") AS MenuActionIDKey,
                        GROUP_CONCAT(c.label SEPARATOR ",") AS MenuActionIDLabel
                    ')
                    ->leftJoin('menus_add_actions AS b', 'a.id', '=', 'b.MenusID')
                    ->join('menus_action AS c', 'b.MenusActionID', '=', 'c.id')
                    ->where('a.key', $keyRoute)
                    ->groupBy('a.id')
                    ->get();
        
        $viewAkses   = false;
        $addAkses    = false;
        $updateAkses = false;
        $deleteAkses = false;

        if (!empty($data[0])) {
            $menuActionIDKey = explode(",", $data[0]->MenuActionIDKey);

            $viewAkses   = in_array('view', $menuActionIDKey)   ? true :  $viewAkses;
            $addAkses    = in_array('add', $menuActionIDKey)    ? true :  $addAkses;
            $updateAkses = in_array('update', $menuActionIDKey) ? true :  $updateAkses;
            $deleteAkses = in_array('delete', $menuActionIDKey)   ? true :  $deleteAkses;
        }

        if (auth()->check() && auth()->user()->role == "superadmin") {
            $viewAkses   = true;
            $addAkses    = true;
            $updateAkses = true;
            $deleteAkses = true;
        }

        return [
           'view'   => $viewAkses, 
           'add'    => $addAkses, 
           'update' => $updateAkses, 
           'delete' => $deleteAkses
        ];
    }
}