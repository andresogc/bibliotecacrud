<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    //
    public function libros(){
        return $this->hasMany(Libro::class);
    }
}
