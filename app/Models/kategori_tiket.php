<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kategori_tiket extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "kategori_tiket";

    protected $fillable = [
        'nama_kategori'
    ];

    public function tikets() {
        return $this->hasMany(tiket::class, 'id_kategori', 'id');
    }

}
