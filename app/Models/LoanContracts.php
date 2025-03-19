<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanContracts extends Model
{
    use HasFactory;

    protected $table = 'loan_contracts';

    protected $fillable = [
        'client_id', 
        'amount', 
        'commercial_manager_id', 
        'regional_manager_id', 
        'superintendent_id', 
        'status'
    ];
}
