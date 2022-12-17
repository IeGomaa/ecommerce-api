<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'stock',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class,'cart_id','id');
    }

    public static function rule()
    {
        return [
            'name' => 'required|string|max:255|unique:products,name',
            'price' => 'required|min:3',
            'stock' => 'required|min:0',
            'category_id' => 'required|exists:categories,id'
        ];
    }

}
