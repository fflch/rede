<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Porta;
use App\Models\Mac;
use Carbon\Carbon;

class Snapshot extends Model
{
    use HasFactory;

    public function porta()
    {
        return $this->belongsTo(Porta::class);
    }

    public function macs()
    {
        return $this->hasMany(Mac::class);
    }

    public function getColetadoEmAttribute()
    {
        if($this->attributes['created_at']){
            return  Carbon::parse($this->attributes['created_at'])->format('d/m/Y H:i');
        }
    }
}
