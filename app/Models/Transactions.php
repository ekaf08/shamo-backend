<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Transactions extends Model
{
    use SoftDeletes, HasApiTokens;

    protected $table   = 'transactions';
    protected $guarded = [];
}
