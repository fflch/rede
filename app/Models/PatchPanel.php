<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatchPanel extends Model
{
    protected $fillable = ['nome', 'rack_id', 'qtde_portas'];

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public function salas()
    {
        return $this->belongsToMany(Sala::class)->withPivot('porta');
    }
}
