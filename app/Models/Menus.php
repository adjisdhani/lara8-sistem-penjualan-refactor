<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MenusAddAction;

class Menus extends Model
{
    use HasFactory;

    protected $table    = 'menus';
    protected $fillable = ["label", "route", "icon", "key", "roles", "Status"];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query
                ->where('label', 'like', '%' . $search . '%');
        });
    }

    public function menusAddActions()
    {
        return $this->hasMany(MenusAddAction::class, 'MenusID', 'id');
    }

}