<?php
/**
 * Created by PhpStorm.
 * User: youstair
 * Date: 19-3-25
 * Time: 下午5:46
 */
$in="fi.txt";
$out="fo.txt";
$fin=fopen($in,'w+');
$tmp="123456";
$st=fwrite($fin,$tmp);
fclose($fin);
var_dump($st);
//$fout = fopen($out, "r");
//if ($fout)
//{
//    unset($_SESSION['res']);
//    $_SESSION['res']=[];
//    while (!feof($fout)) {
//        $buffer = fgets($fout, 100);
//        array_push($_SESSION['res'],$buffer);
//    }
//    fclose($fout);
//}