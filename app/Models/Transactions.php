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

    // TODO relasi many (N: transaction) to one (1: users) / kebalikan dari relasi has many yang ada di model users.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // TODO relasi one to many dengan tabel transactions_item
    public function items()
    {
        return $this->hasMany(TransactionsItem::class, 'transaction_id', 'id');
    }
}
