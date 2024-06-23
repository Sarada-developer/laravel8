<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function setFilenamesAttribute($value)
    {
        $this->attributes['filenames'] = json_encode($value);
    }

    public function category(){

        return $this->belongsTo(Category::class);
    }
}
