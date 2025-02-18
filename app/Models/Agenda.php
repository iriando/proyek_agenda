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

    public function getStatusAttribute() //update status agenda
    {
        $now = Carbon::now();

        if ($now->lt($this->tanggal_pelaksanaan)) {
            return 'Belum Dimulai';
        } elseif ($now->between($this->tanggal_pelaksanaan, $this->tanggal_selesai)) {
            return 'Sedang Berlangsung';
        } else {
            return 'Selesai';
        }
    }
}
