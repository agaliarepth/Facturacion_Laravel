<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table= "productos";
    protected  $fillable=['descripcion','pu','cu','codbarras','foto',"categorias_id","unidad","tipo","estado"];
    protected  $hidden=[];


    public function  categoria(){


    	return $this->belongsTo('App\Models\categoria','categorias_id');
    }

}
