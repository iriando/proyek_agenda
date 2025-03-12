<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(User::class);
    }

    // public function role(){
    //     return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    //     }
}
