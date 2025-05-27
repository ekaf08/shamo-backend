<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Roles extends Model
{
    use SoftDeletes, HasApiTokens, HasFactory;

    protected $guarded = [];
    protected $table   = 'roles';

    protected $hidden = [
        'deleted_at',
    ];

    public function role_users()
    {
        $data = $this->hasMany(User::class, 'role_id', 'id');
        return $data;
    }
}
