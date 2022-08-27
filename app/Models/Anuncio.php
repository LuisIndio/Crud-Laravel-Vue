<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;
    protected $fillable = ['titulo','descripcion','numero','user_id','imagen'];

    public function categorias()
    {
        return $this->hasMany(Categoria::class);

    }
    public function usuarios()
    {
        return $this->belongsTo(User::Class);
    }
}
