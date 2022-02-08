<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bbs_model extends Model
{
    protected $table = 'bbs';
    
    protected $fillable = [
        "id",
        "date",
        "name",
        "category",
        "subCategory",
        "message",
    ];
}
