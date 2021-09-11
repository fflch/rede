<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipamento;
use App\Models\Snapshot;

class Porta extends Model
{
    use HasFactory;

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }
    
    public function snapshots()
    {
        return $this->hasMany(Snapshot::class);
    }

    public function latest_snapshot()
    {
        return $this->hasOne(Snapshot::class)->latest();
    }
}
