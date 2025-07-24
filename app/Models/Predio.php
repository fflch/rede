<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Predio extends Model
{
    protected $fillable = ['nome', 'descricao'];

    public function salas()
    {
        return $this->hasMany(Sala::class);
    }

    public function racks()
    {
        return $this->hasMany(Rack::class);
    }

    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class);
    }
}
