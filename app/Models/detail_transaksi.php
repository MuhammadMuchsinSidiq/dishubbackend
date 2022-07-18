<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    use HasFactory;
    
    public $table = "detail_transaksi";

    protected $fillable = [
        'id_transaksi',
        'id_tiket',
        'id_user',
        'quantity'
    ];
    
    public function tiket() {
        return $this->hasOne(tiket::class, 'id', 'id_tiket');
    }
}
