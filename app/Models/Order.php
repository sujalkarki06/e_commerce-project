<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'total', 
        'status',
        'name',
        'address',
        'city',
        'postal_code',
        'country',
        'payment_method',
        'phone',
        'delivery_status',  // Added field
        'tracking_number',  // Added field
        'estimated_delivery',  // Added field
        'shipping_provider',  // Added field
    ];

    // protected static function boot()
    // {
    //     parent::boot();
        
    //     static::creating(function ($order) {
    //         $order->order_id = (string) Str::uuid(); // Generate a UUID
    //     });
    // }

    
    // public function items()
    // {
    //     return $this->hasMany(OrderItem::class);
    // }
//     public function items()
// {
//     return $this->belongsToMany(Product::class, 'order_items') // assuming 'order_items' is your pivot table
//                 ->withPivot('quantity', 'price');
// }
// public function items()
//     {
//         return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
//     }
    public function items()
    {
        return $this->hasMany(OrderItem::class); // Ensure this matches your actual model
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
{
    return $this->belongsToMany(Product::class, 'order_product')
                ->withPivot('quantity', 'price');
}

}
