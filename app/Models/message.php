<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'message',
        'teachers_id',


    ];


    // public function user()
    //     {
    //     return $this->belongsTo(User::class);
    //     }
    // public function teacher()
    //     {
    //     return $this->belongsTo(User::class);
    //     }
}
