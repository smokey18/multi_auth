<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'title',
        'description',
        'price',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 0, '.', ',') . "$";
    }
}