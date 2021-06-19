<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $table = 'musics';
    public $fillable = [
        'playlist_id',
        'music_name',
        'music_url'
    ];
}
