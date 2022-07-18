<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class galeri_destinasi extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "galeri_destinasi";

    protected $fillable = [
        'id_destinasi',
        'url_images'
    ];
    public function getUrlAttributes($url_images)
    {
        return config('app.url') . Storage::url_images($url_images);
    }
}

