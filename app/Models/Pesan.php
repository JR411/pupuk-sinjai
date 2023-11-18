<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pesan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['user'];

    public function scopePetani($query, array $cari)
    {
        $query->when($cari['search'] ?? false, function($query, $search){
            return $query->where('alamat', 'like', '%'.$search.'%')
                        ->orwhere('status', 'like', '%'.$search.'%')
                        ->orwhereHas('distributors', function ($quer) use ($search) {
                            $quer->where('cv', 'like', '%'.$search.'%');
                            $quer->orwhere('no', 'like', '%'.$search.'%');
                          });
        });
    }

    public function scopeDistributor($query, array $cari)
    {
        $query->when($cari['search'] ?? false, function($query, $search){
            return $query->where('alamat', 'like', '%'.$search.'%')
                        ->orwhere('status', 'like', '%'.$search.'%')
                        ->orwhereHas('petanis', function ($quer) use ($search) {
                            $quer->where('nama', 'like', '%'.$search.'%');
                            $quer->orwhere('no', 'like', '%'.$search.'%');
                        });
        });
    }

    public function scopePemerintah($query, array $cari)
    {
        $query->when($cari['search'] ?? false, function($query, $search){
            return $query->where('alamat', 'like', '%'.$search.'%')
                        ->orwhere('status', 'like', '%'.$search.'%')
                        ->orwhereHas('petanis', function ($quer) use ($search) {
                            $quer->where('nama', 'like', '%'.$search.'%');
                            $quer->orwhere('no', 'like', '%'.$search.'%');
                            })
                        ->orwhereHas('distributors', function ($quer) use ($search) {
                            $quer->where('cv', 'like', '%'.$search.'%');
                            $quer->orwhere('no', 'like', '%'.$search.'%');
                            });
        });
    }

    public function petanis()
    {
        return $this->belongsTo(Petani::class, 'petani_id', 'id');
    }

     public function distributors()
    {
        return $this->belongsTo(Distributor::class, 'distributor_id', 'id');
    }
}
