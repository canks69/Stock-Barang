<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $table = 'purchasedetail';

    protected $fillable = [
        'transno',
        'item_id',
        'qty',
        'price',
        'total',
        'created_by',
        'updated_by',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'transno', 'transno');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
