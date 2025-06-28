<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenusAction extends Model
{
    use HasFactory;

    protected $table    = 'menus_action';
    protected $fillable = ["key", "label", "Status"];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query
                ->where('label', 'like', '%' . $search . '%');
        });
    }
}
