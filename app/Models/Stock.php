<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    protected $fillable = [
        'product_name',
        'quantity',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function salesdetail()
    {
        return $this->hasMany(SalesDetail::class);
    }

    public function purchasedetail()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
