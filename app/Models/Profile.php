<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSupplier($query, $id)
    {
        return $query->where('profilable_type',Supplier::class)->where('profilable_id',$id);
    }
}
