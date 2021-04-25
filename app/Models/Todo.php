<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable=['user_id','title','completed'];
    protected $hidden=['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
