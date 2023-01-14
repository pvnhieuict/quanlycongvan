<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Documentin extends Model
{
    use HasFactory;
    //protected $guarded = ['documentins'];

    protected $fillable = ['label_number', 'title', 'type_id', 'secret', 'status', 'pathpdf', 'namepdf', 'signature', '	signature_date', 'in_date', 'store_date', 'detail', 'copy_number', 'from_place','ngaydenhan','nguoiphutrach'];
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
    
}
