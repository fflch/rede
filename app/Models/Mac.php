<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Snapshot;

class Mac extends Model
{
    use HasFactory;

    public function snapshot()
    {
        return $this->belongsTo(Snapshot::class);
    }
}
