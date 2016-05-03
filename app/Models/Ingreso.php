<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table= "ingresos";
    protected  $fillable=['concepto','documento','numdocu','fecha','obser',"estado","terminado","total"];
    protected  $hidden=[];


    public function  detalleingresos(){


        return $this->hasMany('App\Models\detalleIngresos');
    }

}
