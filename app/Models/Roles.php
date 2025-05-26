<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Roles extends Model
{
    use SoftDeletes, HasApiTokens;

    protected $guarded = [];
    protected $table   = 'roles';

    protected $hidden = [
        'deleted_at',
    ];
}
