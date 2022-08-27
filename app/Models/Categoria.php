<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','anuncio_id'];

    public function anuncios()
    {
        return $this->belongsTo('App/Models/Anuncio');
    }
}
