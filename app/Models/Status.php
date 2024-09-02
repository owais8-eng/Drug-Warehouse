<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Relations\HasMany;
class Status extends Model
{
    use HasFactory;

    protected $table = 'status';
   protected $fillable = ['status_name',];


   public function order():HasMany 
   {
       return $this->hasMany(Order::class,'status_id','id');
       
   }

}
