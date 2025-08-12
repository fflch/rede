<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    protected $fillable = [
        'nome', 'predio_id', 'user_id', 'updated_by'
    ];

    public function criador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function predio()
    {
        return $this->belongsTo(Predio::class);
    }

    public function patchPanels()
    {
        return $this->hasMany(PatchPanel::class);
    }

    public function equipamentos()
    {
        return $this->hasMany(Equipamento::class);
    }
}