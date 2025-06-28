<?php

namespace Database\Seeders;


use App\Models\Menus;
use DateTime;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    public function run()
    {
        Menus::insert([
            [
                'label' => 'Dashboard',
                'route' => '/',
                'icon'  => 'home',
                'key'   => 'dashboard',
                'roles' => 'superadmin,staff,user',
            ],
            [
                'label' => 'Data Jenis Penjualan',
                'route' => 'jenis-penjualan',
                'icon'  => 'database',
                'key'   => 'jenis_penjualan',
                'roles' => 'superadmin,staff',
            ],
            [
                'label' => 'Data Barang',
                'route' => 'barang-penjualan',
                'icon' => 'database',
                'key'   => 'barang_penjualan',
                'roles' => 'superadmin,staff',
            ],
            [
                'label' => 'Data Master Penjualan',
                'route' => 'master-penjualan',
                'icon' => 'database',
                'key'   => 'master_penjualan',
                'roles' => 'superadmin,staff',
            ],
            [
                'label' => 'Data Transaksi Penjualan',
                'route' => 'transaksi-penjualan',
                'icon' => 'database',
                'key'   => 'transaksi_penjualan',
                'roles' => 'superadmin,staff',
            ],
            [
                'label' => 'Setting User',
                'route' => 'setting-user',
                'icon'  => 'user',
                'key'   => 'setting_user',
                'roles' => 'superadmin',
            ],
            [
                'label' => 'Setting Menu',
                'route' => 'setting-menu',
                'icon'  => 'menu',
                'key'   => 'setting_menu',
                'roles' => 'superadmin',
            ],
            [
                'label' => 'Export Data',
                'route' => 'export-data',
                'icon'  => 'download',
                'key'   => 'export_data',
                'roles' => 'superadmin,staff,user',
            ],
            [
                'label' => 'Logout',
                'route' => 'logout',
                'icon' => 'log-out',
                'key'   => 'logout',
                'roles' => 'superadmin,staff,user',
            ]
        ]);
    }
}