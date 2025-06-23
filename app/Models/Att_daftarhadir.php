<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Att_daftarhadir extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'is_active',
    ];

    // public function agenda(){
    //     return $this->hasMany(Agenda::class,);
    // }

    public function instansi(){
        return $this->hasMany(Instansi::class, 'att_id', 'id');
    }
}
