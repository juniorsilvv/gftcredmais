<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commissions extends Model
{
    use HasFactory;

    protected $table = 'comissions';

    protected $fillable = [
        'loan_contract_id', 
        'user_id', 
        'role', 
        'amount', 
    ];
}
