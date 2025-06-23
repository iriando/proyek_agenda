<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'slidolink',
        'zoomlink',
        'tanggal_pelaksanaan',
        'tanggal_selesai',
        'poster',
        'certificate_template',
        'linksertifikat',
        'vb',
        'att_daftarhadir_id'
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];


    public function materi(){
        return $this->hasMany(Materi::class);
    }

    public function pemateri(){
        return $this->hasMany(Pemateri::class);
    }

    public function peserta(){
        return $this->hasMany(Peserta::class);
    }

    public function surveys(){
        return $this->hasmany(Survey::class);
    }

    public function links(){
        return $this->hasmany(Link_add::class);
    }

    public function attdaftarhadir(){
        return $this->belongsTo(Att_daftarhadir::class, 'att_daftarhadir_id', 'id');
    }

    public function getStatusAttribute() //accessornya
    {
        $now = Carbon::now('GMT+9')->format('Y-m-d H:i:s'); // Ambil tanggal sekarang dalam format YYYY-MM-DD
        $startDate = Carbon::parse($this->tanggal_pelaksanaan)->format('Y-m-d H:i:s');
        $endDate = Carbon::parse($this->tanggal_selesai)->format('Y-m-d H:i:s');

        if ($startDate > $now) {
            return 'Belum Dimulai';
        } elseif ($startDate <= $now && $endDate >= $now) {
            return 'Sedang Berlangsung';
        } else {
            return 'Selesai';
        }
    }

    protected static function boot()
    {
        parent::boot();

        // Buat slug saat agenda baru dibuat
        static::creating(function ($agenda) {
            $agenda->slug = self::generateUniqueSlug($agenda->judul);
        });

        // Perbarui slug jika judul diubah
        static::updating(function ($agenda) {
            if ($agenda->isDirty('judul')) {
                $agenda->slug = self::generateUniqueSlug($agenda->judul);
            }
        });
    }

    // Fungsi untuk memastikan slug unik
    protected static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (Agenda::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
