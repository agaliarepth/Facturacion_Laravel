<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detalleIngresos extends Model
{
         protected  $table="detalleingresos";
         protected $fillable=['cant','ingresos_id','productos_id'];
         protected $hidden=[];
    public  function ingreso(){
        return $this->belongsTo('App\Models\Ingreso','ingresos_id');

    }
    public function producto(){
        return $this->belongsTo('App\Models\Producto','productos_id');
    }
}
