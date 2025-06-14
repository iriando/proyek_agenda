<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey_response extends Model
{
    use HasFactory;
    protected $fillable = [
        'survey_id',
        'question_id',
        'answer',
    ];

    public function survey(){
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function question(){
        return $this->belongsTo(Survey_question::class, 'question_id', 'id');
    }

}
