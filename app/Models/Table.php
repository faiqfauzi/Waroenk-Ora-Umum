<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;


class Table extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'qr_code'];

    protected static function booted()
    {
        static::created(function ($table) {
            $url = url("/table/{$table->id}");
            $path = "qrcodes/table_{$table->id}.svg"; // ubah ke svg

            // Gunakan format SVG agar tidak perlu imagick
            Storage::disk('public')->put($path, QrCode::format('svg')->size(200)->generate($url));

            $table->update(['qr_code' => $path]);
        });
    }
}
