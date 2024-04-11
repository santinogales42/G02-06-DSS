<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $guarded = [];
    //protected $table = 'jugadors';
    use HasFactory;
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function estadisticas()
    {
        return $this->hasOne(Est_jugador::class);
    }
    public function inicializarEstadisticas()
    {
        $this->estadisticas()->create([
            'goles' => 0,
            'asistencias' => 0,
            'amarillas' => 0,
            'rojas' => 0,
            // Agrega aquí todos los campos con sus valores predeterminados.
        ]);
    }

    // Observador para el evento de creación
    protected static function boot()
    {
        parent::boot();

        static::created(function ($jugador) {
            $jugador->inicializarEstadisticas();
        });
    }

}
