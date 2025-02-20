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
        'status_survey',
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
}
