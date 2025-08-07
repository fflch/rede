<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Porta;

class Equipamento extends Model
{
    use HasFactory;

    public function portas()
    {
        return $this->hasMany(Porta::class);
    }

    const model = [
        'hp_comware',
        'alcatel_aos',
    ];
}
