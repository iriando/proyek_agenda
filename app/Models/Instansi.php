<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;
    protected $fillable = [
        'att_id',
        'title',
        'nama_instansi',
        'duplikat',
    ];

    public function attdaftarhadir(){
        return $this->belongsTo(Att_daftarhadir::class, 'att_id', 'id');
    }
}
