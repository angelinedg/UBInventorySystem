<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usermodel extends Model
{
    
    protected $fillable = [
        'id', 'name', 'email', 'password', 'admin',
    ];
    
    
    protected $hidden = [
        'password', 'remember_token',
    ];

}
