<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transaksi extends Model
{
    use HasFactory, SoftDeletes;
 
    public $table = "transaksi";

    protected $fillable = [
        'id_user',
        'pembayaran',
        'status',
        'token',
        'total_harga'

    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function items() {
        return $this->hasMany(detail_transaksi::class, 'id_transaksi', 'id');
    }
}
