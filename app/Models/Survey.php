<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Survey extends Model
{
    use HasFactory;
    protected $fillable = [
        'agenda_id',
        'title',
        'slug',
        'description',
        'is_active',
    ];

    public function agenda(){
        return $this->belongsTo(Agenda::class, 'agenda_id', 'id');
    }

    public function question(){
        return $this->hasMany(Survey_question::class);
    }

    public function response(){
        return $this->hasMany(Survey_response::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Buat slug saat survey baru dibuat
        static::creating(function ($survey) {
            $survey->slug = self::generateUniqueSlug($survey->title);
        });

        // Perbarui slug jika judul diubah
        static::updating(function ($survey) {
            if ($survey->isDirty('title')) {
                $survey->slug = self::generateUniqueSlug($survey->title);
            }
        });
    }

    // Fungsi untuk memastikan slug unik
    protected static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (Survey::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
