<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchase';

    protected $fillable = [
        'transno',
        'transdate',
        'supplier_id',
        'total',
        'status',
        'created_by',
        'updated_by',
    ];

    public function purchasedetail()
    {
        return $this->hasMany(PurchaseDetail::class, 'transno', 'transno');
    }
}
