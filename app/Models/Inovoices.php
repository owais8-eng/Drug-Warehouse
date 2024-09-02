<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;
class Inovoices extends Model
{
    use HasFactory;
    protected $table = 'invoicies';
    protected $fillable = [
        'order_id',
        'medicine_id',
        'amount'
    ];

    public function invoice_medicine()  {
        return $this->hasMany(Medicines::class);
        
    }
    public function invoice_order()  {
        return $this->hasMany(Order::class);
        
    }
    
}
