<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
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

    public function question(){
        return $this->hasMany(Survey_question::class);
    }

    public function answer(){
        return $this->hasMany(Survey_response::class);
    }

}
