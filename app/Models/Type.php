<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
    ];
    public function documentin()
    {
        return $this->hasMany(Documentin::class,'type_id');
    }
    public function documentout()
    {
        return $this->hasMany(Documentout::class,'type_id');
    }


}
