<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'transno',
        'customer_id',
        'address',
        'name',
        'total'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesdetail()
    {
        return $this->hasMany(SalesDetail::class, 'transno', 'transno');
    }
    
}
