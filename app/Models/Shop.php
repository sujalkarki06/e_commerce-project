<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

     // Define the table associated with the model
     protected $table = 'shops'; // Update if necessary

     // Define the fillable fields
     protected $fillable = ['name', 'description', 'price', 'image']; // Update according to your schema
     
     public function averageRating()
{
    return $this->reviews->avg('rating');
}

 
}
