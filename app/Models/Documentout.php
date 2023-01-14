<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentout extends Model
{
    use HasFactory;
    protected $fillable = ['label_number','title','type_id','secret','status','pathpdf','namepdf','signature','	signature_date','out_date','store_date','detail','copy_number','from_place'];
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }
}
