<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Supplier extends Model
{
    use LaratrustUserTrait;
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone'
    ];

    public function profile()
    {
        return $this->morphOne(Profile::class,'profilable');
    }

    public function roleUser()
    {
        return $this->morphOne(RoleUser::class, 'user');
    }
}
