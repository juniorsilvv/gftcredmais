<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanContracts extends Model
{
    use HasFactory;

    protected $table = 'loan_contracts';

    protected $keyType = 'string'; 
    public $incrementing = false; 
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'client_id', 
        'amount', 
        'commercial_manager_id', 
        'regional_manager_id', 
        'superintendent_id', 
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            /**
             * Cria a chave primaria de forma automatica caso não seja setado
             */
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    /**
     * Retorna a relação do gerente comercial
     *
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function commercialManager()
    {
        return $this->belongsTo(User::class, 'commercial_manager_id')->select('id', 'name', 'email');
    }

    /**
     * Retorna a relação com o gerente regional
     *
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function regionalManager()
    {
        return $this->belongsTo(User::class, 'regional_manager_id')->select('id', 'name', 'email');
    }



    /**
     * Retorna a relação com o superintente
     *
     * @return void
     * @author Junior <hamilton.junior@opovodigital.com>
     */
    public function superintendent()
    {
        return $this->belongsTo(User::class, 'superintendent_id')->select('id', 'name', 'email');
    }
}
