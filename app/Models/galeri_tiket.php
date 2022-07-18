<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class galeri_tiket extends Model
{
    use HasFactory, SoftDeletes;
     
    public $table = "galeri_tiket";
    
    protected $fillable = [
        'id_tiket',
        'url_images'
    ];

    public function getUrlAttribute($url_images)
    {
        return config('app.url') . Storage::url_images($url_images);
    }
}
