<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionMoneys extends Model
{
    protected $fillable = [
        'type_billet',
        'quantite',
        'id_bank_transaction',
        'total'
    ];
}
