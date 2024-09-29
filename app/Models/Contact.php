<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact_messages'; // Explicitly define the table name

    protected $fillable = ['name', 'email', 'message', 'replied'];

    public function replies()
    {
        return $this->hasMany(ContactReply::class, 'contact_id'); // Correct foreign key
    }

}
