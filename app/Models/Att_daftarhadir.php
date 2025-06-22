<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Att_daftarhadir extends Model
{
    use HasFactory;
    protected $fillable = [
        'agenda_id',
        'title',
        'description',
        'is_active',
    ];

    public function agenda(){
        return $this->belongsTo(Agenda::class, 'agenda_id', 'id');
    }

    public function instansi(){
        return $this->hasMany(Instansi::class, 'att_id', 'id');
    }

    public function peserta(){
        return $this->hasMany(Peserta::class);
    }
}
