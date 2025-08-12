<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Predio extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'user_id', 'updated_by'
    ];

    public function criador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

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