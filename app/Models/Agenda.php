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
        'zoomlink',
        'tanggal_pelaksanaan',
        'tanggal_selesai',
        // 'status',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];


    public function materi(){
        return $this->hasMany(Materi::class);
    }

    public function pemateri(){
        return $this->hasMany(Pemateri::class, 'agenda_id', 'id');
    }

    public function peserta(){
        return $this->hasMany(Peserta::class);
    }

    public function survey(){
        return $this->hasOne(Survey::class);
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

        static::creating(function ($agenda) {
            $agenda->slug = Str::slug($agenda->judul);

            // Pastikan slug unik
            $originalSlug = $agenda->slug;
            $counter = 1;
            while (Agenda::where('slug', $agenda->slug)->exists()) {
                $agenda->slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
