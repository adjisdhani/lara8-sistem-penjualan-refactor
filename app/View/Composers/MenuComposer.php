<?php
namespace App\View\Composers;

use Illuminate\View\View;

// use App\Models\Menus;

use Illuminate\Support\Facades\DB;

class MenuComposer
{
    public function compose(View $view)
    {
        /* $getDataMenus = Menus::where('Status', 'active')
                               ->orderByRaw("CASE WHEN `key` = 'Logout' THEN 1 ELSE 0 END")
                               ->get(); */

        $menuKeys = ['dashboard', 'logout'];
        $a = "";
        $b = "";

        if (auth()->user()->role === 'superadmin') {
            $menuSpesifik = ['setting_user', 'setting_menu'];
            $menuKeys = array_merge($menuKeys, $menuSpesifik);

            $a = "/*";
            $b = "*/";
        }

        $placeholders = implode(',', array_fill(0, count($menuKeys), '?'));

        $sql = "
            SELECT * FROM (
                SELECT c.*
                FROM menus AS c
                WHERE c.Status = ?
                $a AND c.key IN ($placeholders) $b

                UNION

                SELECT a.*
                FROM menus AS a
                INNER JOIN menus_add_actions AS b ON a.id = b.MenusID
                WHERE a.Status = ?
                AND a.key NOT IN ($placeholders)
                GROUP BY a.id
            ) AS merged
            ORDER BY merged.id ASC
        ";

        $bindings = array_merge(['active'], $menuKeys, ['active'], $menuKeys);

        $getDataMenus = DB::select($sql, $bindings);

        if (!empty($getDataMenus)) {
            foreach($getDataMenus as &$value) {
                $value->route = url($value->route);
                $value->roles = explode(",", $value->roles);
            }
        }

        // $menus = [
        //     [
        //         'label' => 'Dashboard',
        //         'route' => url('/'),
        //         'icon' => 'home',
        //         'key'   => 'dashboard',
        //         'roles' => ['superadmin', 'staff', 'user'],
        //     ],
        //     [
        //         'label' => 'Data Jenis Penjualan',
        //         'route' => url('jenis-penjualan'),
        //         'icon' => 'database',
        //         'key'   => 'jenis_penjualan',
        //         'roles' => ['superadmin', 'staff'],
        //     ],
        //     [
        //         'label' => 'Data Barang',
        //         'route' => url('barang-penjualan'),
        //         'icon' => 'database',
        //         'key'   => 'barang_penjualan',
        //         'roles' => ['superadmin', 'staff'],
        //     ],
        //     [
        //         'label' => 'Data Master Penjualan',
        //         'route' => url('master-penjualan'),
        //         'icon' => 'database',
        //         'key'   => 'master_penjualan',
        //         'roles' => ['superadmin', 'staff'],
        //     ],
        //     [
        //         'label' => 'Data Transaksi Penjualan',
        //         'route' => url('transaksi-penjualan'),
        //         'icon' => 'database',
        //         'key'   => 'transaksi_penjualan',
        //         'roles' => ['superadmin', 'staff'],
        //     ],
        //     [
        //         'label' => 'Setting User',
        //         'route' => route('setting-user.index'),
        //         'icon'  => 'user',
        //         'key'   => 'setting_user',
        //         'roles' => ['superadmin'],
        //     ],
        //     [
        //         'label' => 'Logout',
        //         'route' => url('logout'),
        //         'icon' => 'log-out',
        //         'key'   => 'logout',
        //         'roles' => ['superadmin', 'staff', 'user'],
        //     ]
        // ];

        $view->with('menus', $getDataMenus);
    }
}
