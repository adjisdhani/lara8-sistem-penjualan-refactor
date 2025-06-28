<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenusAction;

class MenusActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenusAction::insert([
            [
                'key'   => 'view',
                'label' => 'View'
            ],
            [
                'key'   => 'add',
                'label' => 'Add'
            ],
            [
                'key'   => 'update',
                'label' => 'Update'
            ],
            [
                'key'   => 'delete',
                'label' => 'Delete'
            ]
        ]);
    }
}
