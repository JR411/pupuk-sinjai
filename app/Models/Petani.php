<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['user'];

    public function scopeCari($query, array $cari)
    {
        $query->when($cari['search'] ?? false, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                ->orWhereYear('updated_at', 'like', '%' . $search . '%');
        });
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function petanis()
    {
        return $this->hasOne(Petani::class, 'petani_id', 'id');
    }

    public function desas()
    {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }
}
