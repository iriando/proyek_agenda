<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link_add extends Model
{
    use HasFactory;
    protected $fillable = [
        'agenda_id',
        'title',
        'link',
        'is_active',
    ];

    public function agenda(){
        return $this->belongsTo(Agenda::class, 'agenda_id', 'id');
    }
}
