<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemateri extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'agenda_id',
    ];

    public function agenda(){
        return $this->belongsTo(Agenda::class, 'agenda_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
