<?php
session_start();
if(count($_POST)>=2)
{
    var_dump($_POST);
    $type=$_POST['type'];
    if($type=='add')
    {
        $val=$_POST['eval'];
        if(!isset($_SESSION['vals']))
        {
            $_SESSION['vals']=[];
        }
        array_push($_SESSION['vals'],html_entity_decode($val));
    }elseif($type=='cls')
    {
        unset($_SESSION['vals']);
        unset($_SESSION['res']);
    }elseif($type=='eq')
    {
        $in="/var/www/html/youstair.com/test_1/php/in.txt";
        $out="/var/www/html/youstair.com/test_1/php/out.txt";
        $fin=fopen($in,'w+');
        $tmp="";
        foreach ($_SESSION['vals'] as $key => $value) {
            $tmp.=($value."\r\n");
        }
        $o=fwrite($fin,$tmp);
        fclose($fin);
        $os=calcprocess($in,$out);
        var_dump($os);
        $fout = fopen($out, "r");
        var_dump($fout);
        $buffer=fgets($fout,2);
        var_dump($buffer);
//        $s=[];
//        if($out){
//            while (!feof($fout)) {
//                $buffer = fgets($fout, 100);
//                array_push($s, $buffer);
//                var_dump($s);
//            }
//            fclose($fout);
//        }

        if ($fout)
        {
            unset($_SESSION['res']);
            $_SESSION['res']=[];
            while (!feof($fout)) {
                $buffer = fgets($fout, 100);
                array_push($_SESSION['res'],$buffer);
            }
            fclose($fout);
        }
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name = "viewport" content="width=device-width">
    <meta charset="UTF-8">
    <!-- Favicon and Title -->
    <title>CalculatorX</title>
    <link rel="shortcut icon" href="favicon.png">
    <style>
    body{
      height: 100%;
    }
    .container{
      height: 100%;
    }
    </style>
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!--    <link rel="stylesheet" type="text/css" href="css/hover-min.css" media="all">-->
    <link href="https://cdn.bootcss.com/hover.css/2.3.1/css/hover-min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/creative.css">
<!--    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">-->
    <link href="http://libs.baidu.com/fontawesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <form id='sub-form' action="index.php" method="post">
      <input id='feval' type="hidden" name="eval" value="">
      <input id='ftype' type="hidden" name="type" value="">
    </form>
    <!-- HTML form and heading -->
    <div class="container">
        <div class="col-md-6  calculator" align="center">
            <div class="row displayBox">
                <div class="displayText" id="display" contenteditable="true" nowrap>0</div>
            </div>
            <div class="row numberPad">
                <div class="col-md-9">
                    <div class="row">
                        <button class="btn clear hvr-back-pulse" id="clear">C</button>
                        <button class="btn btn-calc hvr-radial-out" id="sqrt">√</button>
                        <button class="btn btn-calc hvr-radial-out hvr-radial-out" id="square">x<sup>2</sup></button>
                        <button class="btn btn-calc hvr-radial-out hvr-radial-out" id="backspace"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                    </div>
                    <div class="row">
                        <button class="btn btn-calc hvr-radial-out" id="seven">7</button>
                        <button class="btn btn-calc hvr-radial-out" id="eight">8</button>
                        <button class="btn btn-calc hvr-radial-out" id="nine">9</button>
                        <button class="btn btn-calc hvr-radial-out hvr-radial-out" id="left-b">(</button>
                    </div>
                    <div class="row">
                        <button class="btn btn-calc hvr-radial-out" id="four">4</button>
                        <button class="btn btn-calc hvr-radial-out" id="five">5</button>
                        <button class="btn btn-calc hvr-radial-out" id="six">6</button>
                        <button class="btn btn-calc hvr-radial-out hvr-radial-out" id="right-b">)</button>
                    </div>
                    <div class="row">
                        <button class="btn btn-calc hvr-radial-out" id="one">1</button>
                        <button class="btn btn-calc hvr-radial-out" id="two">2</button>
                        <button class="btn btn-calc hvr-radial-out" id="three">3</button>
                        <button class="btn btn-calc hvr-radial-out hvr-radial-out" id="abs">|</button>
                    </div>
                    <div class="row">
                        <button class="btn btn-calc hvr-radial-out" id="plus_minus">&#177;</button>
                        <button class="btn btn-calc hvr-radial-out" id="zero">0</button>
                        <button class="btn btn-calc hvr-radial-out" id="decimal">.</button>
                        <button class="btn btn-calc hvr-radial-out hvr-radial-out" id="apple" data-toggle="modal" data-target="#myModal"><i class="fa fa-apple" aria-hidden="true"></i></button>
                    </div>
                </div>
                <div class="col-md-3 operationSide">
                    <button id="divide" class="btn btn-operation hvr-fade">÷</button>
                    <button id="multiply" class="btn btn-operation hvr-fade">×</button>
                    <button id="subtract" class="btn btn-operation hvr-fade">−</button>
                    <button id="add" class="btn btn-operation hvr-fade">+</button>
                    <button id="equals" class="btn btn-operation equals hvr-back-pulse"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-6  calculator" align="center" style="height:100%;">
          <div class="row numberPad" style="height:90%;">
            <?php
             foreach ($_SESSION['vals'] as $key => $value) {
               ?>
               <h2 class="bg-success"><?=$value?></h2>
               <?php
             }
            ?>
              <?php
              if(isset($_SESSION['res']))
               foreach ($_SESSION['res'] as $key => $value) {
                 ?>
                 <h2 class="bg-warning"><?=$value?></h2>
                 <?php
               }
              ?>
          </div>
            <div class="row" style="height:10%;">
              <div class="col-md-6" style="height:100%;">
                <button  id="eq" style="height:100%;" class="btn btn-operation equals hvr-back-pulse bottom">=</button>
              </div>
              <div class="col-md-6" style="height:100%;">
                <button style="height:100%;" id="cls" class=" btn btn-operation equals hvr-back-pulse bottom">clear</button>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="modal-close">×</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="fa fa-clone"></span>&nbsp;&nbsp;flex &amp; bison计算器</h4>
                </div>
                <div class="modal-body">
                    <p class="modal-text">
                        后端由PHP7.0、Nginx、Mysql强力驱动，flex &amp; bison做词法、语法分析支持
                    </p>
                </div>
                <div class="modal-footer">
                    王颖
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/calculate.js"></script>
</body>
</html>
