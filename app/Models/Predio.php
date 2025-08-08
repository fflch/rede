<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Predio extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome', 'descricao', 'user_id', 'updated_by', 'deleted_by'];
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

    public function scopeWithTrashed($query)
    {
        return $query->whereNotNull('deleted_at');
    }
}
