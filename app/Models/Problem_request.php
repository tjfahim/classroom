<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem_request extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'subject',
        'date',
        'image',
        'status',
        'users_id',
    ];


        public function user(){
        return $this->belongsTo(User::class,'users_id');
    }
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }

}
