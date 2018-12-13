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


    public function getanswer($ids,$idt)
    {
        unset($out);
        $c=exec("PYTHONIOENCODING=utf-8 /usr/bin/python3 /home/youstair/PycharmProjects/runoob_db/venv/core_model.py $ids $idt",$out,$res);

//        var_dump($c);
//        echo '</br>';
//
//        var_dump($out);
//
//        echo '</br>';
//        var_dump($res);
        return $out;
    }
}
