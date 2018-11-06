<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
class WebService extends Model
{
    //
    protected  $table='WebService';
    protected  $primaryKey='id';
    public  $timestamps=false;
    protected $guarded=[];
}
