<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterUser extends Model
{
    protected $fillable = [
        'fullname','email','password','mobile'
    ];

    /* protected $table = "register"; */
    
       protected $primaryKey ="userid";
}


