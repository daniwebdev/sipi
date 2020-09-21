<?php

namespace TrusCRUD\Core\Models;

use Illuminate\Database\Eloquent\Model;

class UserProvider extends Model
{   
    //
    protected $fillable = [
        "user_id",
        "provider",
        "provider_id",
        "token",
        "data",
    ];
}
