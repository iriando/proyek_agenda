<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey_question extends Model
{
    use HasFactory;
    protected $fillable = [
        'survey_id',
        'question',
        'type',
        'options',
    ];

    protected $casts = [
        'options' => 'array', // Agar opsi disimpan sebagai JSON
    ];

    public function survey(){
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }

    public function response(){
        return $this->hasMany(Survey_response::class, 'question_id', 'id');
    }
}
