<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome', 'predio_id','user_id', 'updated_by', 'deleted_by'];
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
    
    public function predio()
    {
        return $this->belongsTo(Predio::class);
    }

    public function patchPanels()
    {
        return $this->belongsToMany(PatchPanel::class)->withPivot('porta');
    }

    public function scopeWithTrashed($query)
    {
        return $query->whereNotNull('deleted_at');
    }
}
