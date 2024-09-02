<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Relations\HasMany;

class Payments extends Model
{
    use HasFactory;
    protected $table='payments';
    protected $fillable =['payment_name'];

public function order() :HasMany 
{
    return $this->hasMany(Order::class,'payment_id','id');
    
}
}