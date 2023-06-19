<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog_model extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
        'created_at',
        'updated_at',
    ];
}
