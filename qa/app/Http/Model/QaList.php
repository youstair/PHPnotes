<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;


class QaList extends Model
{
    //
    protected  $table='qa_category';
    protected  $primaryKey='cate_id';
    public  $timestamps=false;
    protected $guarded=[];
}
