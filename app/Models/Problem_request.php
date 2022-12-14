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
        'teacher_id',
        'start_time',
        'end_time',
        'user_id',
    ];


    public function user(){
        return $this->belongsTo(User::class,'users_id','teacher_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'problem_request_user');
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }




}
