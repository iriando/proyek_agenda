<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $fillable = [
        'agenda_id',
        'nama_file',
        'file',
    ];

    public function agenda(){
        return $this->belongsTo(Agenda::class, 'agenda_id', 'id');
    }
}
