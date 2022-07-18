<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class jadwal extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "jadwal";

    protected $fillable = [
        'id_tiket',
        'jadwal',
        'nama_driver',
        'status'
    ];

    public function jadwal() {
        return $this->hasOne(tiket::class, 'id', 'id_tiket');
    }
}
