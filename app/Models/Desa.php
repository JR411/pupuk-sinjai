<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $hidden = ['user'];

    public function distributors()
    {
        return $this->belongsTo(Distributor::class, 'distributor_id', 'id');
    }
}
