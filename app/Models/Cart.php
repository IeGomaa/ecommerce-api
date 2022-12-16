<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'product_id',
        'count'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id','id');
    }

}
