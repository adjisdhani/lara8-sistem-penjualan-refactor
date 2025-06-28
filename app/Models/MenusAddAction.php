<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenusAddAction extends Model
{
    use HasFactory;

    protected $table    = 'menus_add_actions';
    protected $fillable = ["MenusID", "MenusActionID"];
}
