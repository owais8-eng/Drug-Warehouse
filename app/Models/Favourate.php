<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourate extends Model
{
    use HasFactory;
    protected $table = 'favourates';
    protected $fillable = [
        'medicine_id',
        'user_id',
 ];


 public function medicine()
 {
     return $this->belongsTo(Medicines::class);
 }
}
