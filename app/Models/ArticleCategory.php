<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    
    //Get File
    function get_cover() {
        return $this->belongsTo(\TrusCRUD\Core\Models\Files::class, 'cover', 'uuid');
    }
}
