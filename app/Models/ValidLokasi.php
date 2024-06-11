<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidLokasi extends Model
{
    use HasFactory;

    protected $table = ['valid_lokasis'];
    protected $guarded = ['id'];
    protected $hidden = ['user'];

    public function distributors()
    {
        return $this->belongsTo(Distributor::class, 'distributor_id', 'id');
    }

    public function petanis()
    {
        return $this->hasOne(Petani::class, 'kelurahan', 'id');
    }
}
