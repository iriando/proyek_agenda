<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
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
}
