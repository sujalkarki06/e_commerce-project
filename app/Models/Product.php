<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'quantity', 
        'image', 
        'category_id'
    ];

    public function category()
{
    return $this->belongsTo(Category::class);
}

// public function users()
//     {
//         return $this->belongsToMany(User::class, 'wishlist');
//     }

public function users(): BelongsToMany
{
    return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id');
}

public function reviews()
{
    return $this->hasMany(Review::class);
}

public function averageRating()
{
    return $this->reviews()->avg('rating');
}

public function wishlists()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    public function isInWishlist()
    {
        if (Auth::check()) {
            return $this->users()->where('user_id', Auth::id())->exists();
        }
        return false;
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
                    ->withPivot('quantity', 'price');
    }
    
    public function getAverageRatingAttribute()
{
    // Calculate the average rating. Adjust the calculation based on your review structure
    return $this->reviews()->avg('rating') ?: 0;
}
}
