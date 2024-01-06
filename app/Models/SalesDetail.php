<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;

    protected $table = 'salesdetail';

    protected $fillable = [
        'transno',
        'stock_id',
        'qty',
        'price',
        'total'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'transno', 'transno');
    }
}
