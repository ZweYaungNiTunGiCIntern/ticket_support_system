<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    //protected $fillable = ['title', 'message', 'priority', 'image', 'category_id','label_id'];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_ticket');
    }

    public function labels(){
        return $this->belongstoMany(Label::class,'label_ticket');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function agent(){
        return $this->belongsTo(User::class,'agent_id','id');
    }
    public function createdByUser($userId)
    {
        return $this->user_id === $userId;
    }
}
