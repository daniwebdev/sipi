<?php

namespace TrusCRUD\Core\Models;

use Illuminate\Database\Eloquent\Model;

class UserApiKey extends Model
{
    
    //Related User
    function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
