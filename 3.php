<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
</head>
<body>
<?php
if($_POST){
    print_r($_POST);
}

?>
<form id="form" action="3.php" method="post">
    <p>
        <input type="text" name="6" id="6" value="" />
    </p>
    <div>
        <input type="text" name="1" id="1" value="0" size="1" />
        <input type="text" name="2" id="2" value="0" size="1"/>
        <input type="text" name="3" id="3" value="0" size="1"/>
        <input type="text" name="4" id="4" value="0" size="1"/>
        <input type="text" name="5" id="5" value="0" size="1"/>
        <input type="text" name="5" id="6" value="0" size="1"/>
        <input type="text" name="5" id="7" value="0" size="1"/>
        <input type="text" name="5" id="8" value="0" size="1"/>
        <input type="text" name="5" id="9" value="0" size="1"/>
        <input type="text" name="5" id="10" value="0" size="1"/>
        <input type="text" name="5" id="11" value="0" size="1"/>
        <input type="text" name="5" id="12" value="0" size="1"/>
        <input type="text" name="5" id="13" value="0" size="1"/>
        <input type="text" name="5" id="14" value="0" size="1"/>
        <input type="text" name="5" id="15" value="0" size="1"/>
        <input type="text" name="5" id="16" value="0" size="1"/>
        <input type="text" name="5" id="17" value="0" size="1"/>
        <input type="text" name="5" id="18" value="0" size="1"/>
        <input type="text" name="5" id="19" value="0" size="1"/>
        <input type="text" name="5" id="20" value="0" size="1"/>
        <input type="text" name="5" id="21" value="0" size="1"/>
        <input type="text" name="5" id="22" value="0" size="1"/>
        <input type="text" name="5" id="23" value="0" size="1"/>
        <input type="text" name="5" id="24" value="0" size="1"/>
    </div>
    <input type="submit" value="提交">
</form>

</body>
</html>
<script>
    var count;
    $("p input").change(function(){
        count=$(this).val();
        One_sixth=count/24;
        var list=$('div input');
        for (var i=0;i<list.length;i++) {//alert(i);alert(list.length-1);


            if(i==list.length-1){
                list[i].value=count;
            }else{
                list[i].value=parseInt(   (i+1)*One_sixth);
                count-=list[i].value;
            }



           /* e=0.026;
            if(i==0){
                list[i].value=Math.round(count*e);
            }
            if(i==1){
                list[i].value=Math.round(count*e);
            }
            if(i==2){
                list[i].value=Math.round(count*e);
            }
            if(i==3){
                list[i].value=Math.round(count*e);
            }
            if(i==4){
                list[i].value=Math.round(count*e);
            }
            if(i==5){
                list[i].value=Math.round(count*e)*2;
            }
            if(i==6){
                list[i].value=Math.round(count*e);
            }
            if(i==7){
                list[i].value=Math.round(count*e);
            }
            if(i==8){
                list[i].value=Math.round(count*e);
            }
            if(i==9){
                list[i].value=Math.round(count*e);
            }
            if(i==10){
                list[i].value=Math.round(count*e);
            }
            if(i==11){
                list[i].value=Math.round(count*e);
            }
            if(i==12){
                list[i].value=Math.round(count*e);
            }
            if(i==13){
                list[i].value=Math.round(count*e);
            }
            if(i==14){
                list[i].value=Math.round(count*e);
            }
            if(i==15){
                list[i].value=Math.round(count*e);
            }
            if(i==16){
                list[i].value=Math.round(count*e);
            }
            if(i==17){
                list[i].value=Math.round(count*e);
            }
            if(i==18){
                list[i].value=Math.round(count*e);
            }
            if(i==19){
                list[i].value=Math.round(count*e);
            }
            if(i==20){
                list[i].value=Math.round(count*e);
            }
            if(i==21){
                list[i].value=Math.round(count*e);
            }
            if(i==22){
                list[i].value=Math.round(count*e);
            }
            if(i==23){
                list[i].value=Math.round(count*e);
            }*/







        }
    })
    $("div input").change(function(){
        var list=$('div input');
        count=0;
        for (var i=0;i<list.length;i++) {
            count+=parseInt(list [i].value);
        }
        $('p input').val(count);
    })
</script>