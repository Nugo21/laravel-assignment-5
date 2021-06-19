<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayList extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'user_id',
        'max_items'
    ];

    public function music(){
        return $this->hasMany(Music::class,'playlist_id');
    }
}
