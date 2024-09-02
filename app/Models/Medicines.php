<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicines extends Model
{
    use HasFactory;
    protected $table = 'medicines';
    protected $fillable = [

        'scentific_name',
        'trade_name',
        'category_id',
        'company',
        'amount',
        'expiry_date',
        'price'
    ];

    public function favourates()
    {
        return $this->hasMany(Favourate::class);
    }
    

}
