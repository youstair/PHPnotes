$(document).ready(function() {
    var displayBox = document.getElementById("display");
    $('#display').keyup(function(){
      checkLength(displayBox.innerHTML);
      //$('#display').html($('#display').html().replace('/\n/g',''));
    });
    //CHECK IF 0 IS PRESENT. IF IT IS, OVERRIDE IT, ELSE APPEND VALUE TO DISPLAY
    function clickNumbers(val) {
        if(displayBox.innerHTML === "0") { displayBox.innerHTML = val; }
        else { displayBox.innerHTML += val; }
    }

    //PLUS MINUS
    $("#plus_minus").click(function() {
        if(eval(displayBox.innerHTML) > 0) {
            displayBox.innerHTML = "-" + displayBox.innerHTML;
        }
        else {
            displayBox.innerHTML = displayBox.innerHTML.replace("-", "");
        }
    });

    //ON CLICK ON NUMBERS
    $("#clear").click(function() {
        displayBox.innerHTML = "0";
        $("#display").css("font-size", "80px");
        $("#display").css("margin-top", "110px");
        $("button").prop("disabled", false);
    });
    $("#one").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers(1);
    });
    $("#two").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers(2);
    });
    $("#three").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers(3);
    });
    $("#four").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers(4);
    });
    $("#five").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers(5);
    });
    $("#six").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers(6);
    });
    $("#seven").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers(7);
    });
    $("#eight").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers(8);
    });
    $("#nine").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers(9);
    });
    $("#zero").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers(0);
    });
    $("#decimal").click(function() {
        if(displayBox.innerHTML.indexOf(".") === -1
            || (displayBox.innerHTML.indexOf(".") !== -1 && displayBox.innerHTML.indexOf("+") !== -1)
            || (displayBox.innerHTML.indexOf(".") !== -1 && displayBox.innerHTML.indexOf("-") !== -1)
            || (displayBox.innerHTML.indexOf(".") !== -1 && displayBox.innerHTML.indexOf("×") !== -1)
            || (displayBox.innerHTML.indexOf(".") !== -1 && displayBox.innerHTML.indexOf("÷") !== -1)) {
            clickNumbers(".");
        }
    });
    $("#backspace").click(function() {
        checkLength(displayBox.innerHTML);
        var str=displayBox.innerHTML;
        var len=str.length;
        if(len>1)
          displayBox.innerHTML=str.substring(0,len-1);
        else {
          displayBox.innerHTML=0;
        }
    });
    $("#left-b").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers("(");
    });
    $("#right-b").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers(")");
    });
    //OPERATORS
    $("#add").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers("+");
    });
    $("#subtract").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers("-");
    });
    $("#multiply").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers("*");
    });
    $("#divide").click(function() {
        checkLength(displayBox.innerHTML);
        clickNumbers("/");
    });
    $("#square").click(function() {
        checkLength(displayBox.innerHTML);
        displayBox.innerHTML = "pow("+displayBox.innerHTML+",2)";
    });
    $("#sqrt").click(function() {
      checkLength(displayBox.innerHTML);
      displayBox.innerHTML = "sqrt("+displayBox.innerHTML+")";
    });
    $("#abs").click(function() {
      checkLength(displayBox.innerHTML);
      displayBox.innerHTML = "|"+displayBox.innerHTML;
    });
    $('#equals').click(function() {
        $('#feval').attr('value',$('#display').text());
        $('#ftype').attr('value','add');
        $('#sub-form').submit();
    });
    $('#eq').click(function(){
      $('#feval').attr('value','*');
      $('#ftype').attr('value','eq');
      $('#sub-form').submit();
    });
    $('#cls').click(function(){
      $('#feval').attr('value','*');
      $('#ftype').attr('value','cls');
      $('#sub-form').submit();
    });

    //CHECK FOR LENGTH & DISABLING BUTTONS
    function checkLength(num) {
        if(num.toString().length > 7) {
            $("#display").css("font-size", "35px");
            $("#display").css("margin-top", "174px");
        }
        else{
          $("#display").css("font-size", "80px");
          $("#display").css("margin-top", "110px");
        }/*
        else if(num.toString().length > 16) {
            num = "Infinity";
            $("button").prop("disabled", true);
            $(".clear").attr("disabled", false);
        }*/
    }


});
