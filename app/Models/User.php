<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'user',
        'email',
        'password',
        'profile_image',
        'phone',
        'birthdate',
        'address',
        'prioridad', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'date',
    ];

    /**
     * Relación: un usuario puede tener muchas tareas
     */
    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }

    /**
     * Obtiene la prioridad del usuario en formato legible
     */
    public function getPrioridadLabelAttribute()
    {
        return ucfirst($this->prioridad);
    }
}
