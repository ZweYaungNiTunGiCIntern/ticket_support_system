<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function label(){
        return $this->belongstoMany(Label::class);
    }
}
