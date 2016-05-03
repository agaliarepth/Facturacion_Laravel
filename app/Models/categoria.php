<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    protected $table= "categorias";
    protected  $fillable=['descripcion'];
    protected  $hidden=[];

    
    public function  productos(){

    	return $this->hasMany('App\Models\Producto');
    }

}
