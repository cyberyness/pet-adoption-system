<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
     protected $fillable = [
        'name','type','breed','age','gender','weight',
        'vaccinated','status', 'file_name', 'user_id'
    ];
}
