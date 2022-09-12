<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;



    public function problem_request(){
        return $this->belongsTo(Problem_request::class);
    }
}
