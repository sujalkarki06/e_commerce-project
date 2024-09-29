<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactReply extends Model
{
    use HasFactory;

    protected $fillable = ['contact_id', 'reply']; // Adjusted column name

    // Define the relationship to the Contact model
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
