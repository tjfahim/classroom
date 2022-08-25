<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create(
            [
                "name"=>"teacher",
                "email"=>"teacher@gmail.com",
                "password"=>"teacher",
                'qualification'=>'math'
            ]
            );
            User::create(
                [
                    "name"=>"fahim",
                    "email"=>"fahim@gmail.com",
                    "password"=>"fahim"
                ]
                );
    }
}
