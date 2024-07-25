<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['judul','deskripsi','foto','url_video','id_kategori'];
    use HasFactory;
    public function kategori(){
        return $this->belongsTo(kategori::class,'id_kategori');
    }
    public function genre(){
        return $this->belongsToMany(Genre::class,'genre_films','id_film','id_genre');
    }
    public function actor(){
        return $this->belongsToMany(Actor::class,'actor_films','id_film','id_actor');
    }
}
