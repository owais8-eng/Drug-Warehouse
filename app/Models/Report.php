<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';
    protected $fillable = [
        'is_order',
        'user_id',
        'from',
        'to',
        'total',
        'date',


    ];
    public function user(){
        return $this->hasMany('users');
    }
}
