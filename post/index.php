<html>       
<head>       
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">       
<title>带有图片预览功能的上传表单</title>       
<script>       
function viewmypic(mypic,imgfile) {        
if (imgfile.value){        
mypic.src=imgfile.value;        
mypic.style.display="";        
mypic.border=1;        
}        
}        
</script>       
</head>       
<body>       
<center>       
<form action="http://www.ar.com/index.php?s=/Apis/upfile" method="post" enctype="multipart/form-data">     
	<input name="apisimg" type="file" id="apisimg" size="40" /> <br />   
	<input name="apis" type="hidden" value="1"  /> 
	<input type="submit" value="Submit" />
</form>       
<img name="showimg" id="showimg" src="" style="display:none;" alt="预览图片" />       
<br />       
</div>       
<div style="display:none">       
</div>       
</center>       
</body>       
</html>