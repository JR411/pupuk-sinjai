<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['user'];

    public function scopeCari($query, array $cari)
    {
        $query->when($cari['search'] ?? false, function ($query, $search) {
            return $query->where('cv', 'like', '%' . $search . '%')
                ->orwhere('no', 'like', '%' . $search . '%')
                ->orwhere('urea', 'like', '%' . $search . '%')
                ->orwhere('za', 'like', '%' . $search . '%')
                ->orwhere('npk', 'like', '%' . $search . '%');
        });
    }
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pesans()
    {
        return $this->hasMany(Pesan::class, 'distributor_id', 'id');
    }

    public function desas()
    {
        return $this->hasMany(Desa::class, 'distributor_id', 'id');
    }
}
