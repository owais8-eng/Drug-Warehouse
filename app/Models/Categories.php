<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Relations\HasMany; 

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable =
    [
     'name'      
    ];

    public function med() :HasMany  
    {
        return $this->hasMany(Medicines::class,'category_id');
        
    }
}

