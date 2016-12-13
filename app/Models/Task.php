<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Obtiene el usuario de la tarea
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
