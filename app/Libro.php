<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Libro extends Model
{
    //
    protected $table = 'libros';

    protected $fillable = ['categoria_id','titulo', 'autor', 'editorial'];


    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

}
