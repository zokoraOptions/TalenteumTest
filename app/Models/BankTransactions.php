<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTransactions extends Model
{
    protected $fillable = [
        'id_type',
        'operation_date',
        'note',
        'total'
    ];
}
