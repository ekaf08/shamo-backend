<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class TransactionsItem extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $table   = 'transactions_item';
    protected $guarded = [];
}
