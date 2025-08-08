<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatchPanel extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['nome', 'rack_id', 'qtde_portas', 'user_id', 'updated_by', 'deleted_by'];
    protected $dates = ['deleted_at'];

    public function criador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletador()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public function salas()
    {
        return $this->belongsToMany(Sala::class)->withPivot('porta');
    }

    public function salasVinculadas()
    {
        return $this->belongsToMany(Sala::class, 'patch_panel_sala', 'patch_panel_id', 'sala_id')
                    ->withPivot('porta')
                    ->withTimestamps();
    }

    public function getVinculoPorPorta($porta)
    {
        return $this->salasVinculadas()
                ->wherePivot('porta', $porta)
                ->first();
    }

    public function scopeWithTrashed($query)
    {
        return $query->whereNotNull('deleted_at');
    }
}
