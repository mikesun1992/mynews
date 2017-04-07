<?php
include_once('/user/getCookie.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>首页</title>
<style>
.div1{ width:800px; height:500px; border:1px solid gray; margin-left:50px; margin-top:110px;}
.arrowdiv{width:28px;height:50px; position:absolute; display:none;top:390px;}
.yuandiv{width:20px; height:20px; border:1px solid gray; border-radius:20px; float:left; margin-left:20px; }
.xyuan{ margin-left:2px; margin-top:2px;}
.copyright{ margin-left:auto; margin-right:auto; text-align:center; margin-top:30px; font-size:18px; color:#FFFFFF}
.allyuandiv{width:230px; height:25px; position:absolute; margin-left:290px; top:630px; left: 57px;}
.Newsdiv{width:500px;height:500px;border:1px solid gray;position:absolute;left:860px;top:169px; background-color:#FFFFFF;opacity:0.8}
li{list-style:none;padding:0;margin:0;}
.NewsText{ float:left; width:100%;height:40px; line-height:40px;}

.delete{ height:50px; border-bottom:1px solid gray; text-align:center; line-height:50px;}
.overflow{overflow-y:auto; width:100%; height:450px;}
.timediv{float:left;width:250px;height:50px;text-align:center;position:absolute;left: 72px;top: 612px;}
.fonttime{ font-size:32px; color:#FFFFFF; font-family:LcdD;}
.fontdate{ font-size:16px; color:#FFFFFF;}
</style>
</head>



<body style="background-image:url(img/bg.jpg); background-repeat:no-repeat;" onload="startTime()" >
<div style=" width:550px; margin-left:auto; margin-right:auto; color:#FFFFFF; font-family:'叶根友毛笔行书2.0版';"><h1>欢  迎 来 到 我 的 电 影 世 界</h1></div>
<div class="timediv" id="timetext" name="timetext"></div>
<div style="float:right; width:400px; height:40px; border:1px solid gray; border-radius:10px; line-height:40px;background-color:#FFFFFF;opacity:0.8;">
<!--引入身份信息页面-->
<?php
include_once('user/checkloginstatus.php');
 ?></div>

<div class="div1" onmouseover="clearInterval(timer);ArrowAppear();" onmouseout="timer=setInterval('Play()',1500);ArrowDisappear()"><a href="" id="Link" name="Link" title=""  target="_blank"><img src="img/000.jpg" id="ImgTarget" name="ImgTarget"/></a>
<div class="arrowdiv" style="margin-left:10px; " id="leftarrow" name="leftarrow"; onclick="TurnLeft()"><img src="img/leftarrow.png" /></div>
<div class="arrowdiv" style="margin-left:765px;" id="rightarrow" name="rightarrow";><img src="img/rightarrow.png"  onclick="TurnRight()"/></div>

<div  class="allyuandiv">

<div  class="yuandiv" onClick="Init(0)" ><div style="display:none" id="xdiv[]" name="xdiv[]"><img src="img/dian.png" class="xyuan"></div></div>
<div  class="yuandiv" onClick="Init(1)"><div style="display:none" id="xdiv[]" name="xdiv[]"><img src="img/dian.png" class="xyuan"></div></div>
<div  class="yuandiv" onClick="Init(2)"><div style="display:none" id="xdiv[]" name="xdiv[]"><img src="img/dian.png" class="xyuan"></div></div>
<div  class="yuandiv" onClick="Init(3)"><div style="display:none" id="xdiv[]" name="xdiv[]"><img src="img/dian.png" class="xyuan"></div></div>
<div  class="yuandiv" onClick="Init(4)"><div style="display:none" id="xdiv[]" name="xdiv[]"><img src="img/dian.png" class="xyuan"></div></div>
</div>  
</div>


<div class="Newsdiv" >
<div class="delete">


<?php
//管理员具有批量删除的功能
//用户角色
$roleName=$user['rolename'];
if($_SESSION['user']!='' && substr_count('管理员',$roleName)>0){

echo " <li>
<input type='checkbox' onClick='SelectAll(this)'>全选/全不选
<input type='button' value=' 删除 ' onClick='DeleteByNewsIds()'>
<a href='user/addnews.php'><input type='button' value=' 添加 ' onClick=''></a>
<input type='button' value=' 修改 ' onClick='AlterSelected()'></li>";
}


?>
</div>
<div class="overflow">

<div class="NewsText">
<?php


include_once("mysql/MysqlHelper.php");
$result=Execute('select newsid,title,addTime,clickcount from news order by newsID desc');
while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
//点击率>=10显示火热图片
$hotimg='';
if($row['clickcount']>=10)
$hotimg="<img src='img/hot.gif'>";

//当天的消息显示new的图片。
$newimg='';
if(date('Ymd',$row[addTime])==date('Ymd',time()+8*3600))
$newimg="<img src='img/new.gif'>";


//管理员具有编辑权限
$editNews='';
if($_SESSION['user']!='' && substr_count('管理员',$roleName)>0)
$editNews="<a href='user/addnews.php' title='添加'><img src='img/add.png' width='20px' height='20px'></a> <a href='user/addnews.php?nid=$row[newsid]' title='修改'><img src='img/edit.png' width='20px' height='20px'></a> <a href='javascript:if(confirm(\"确认删除吗？\"))window.location.href=\"user/dodeletenews.php?nid=$row[newsid]\";' title='删除'><img src='img/delete.png' width='18px' height='18px'></a> ";

//管理员具有批量删除权限
$cbo='';
if($_SESSION['user']!='' && substr_count('管理员',$roleName)>0)
$cbo="<input type='checkbox' name='cbonewsid' id='cbonewsid' value='$row[newsid]'>";

//读取时列名一定要区分大小写
echo '<li>'.$cbo.''.$hotimg.''.$newimg.'<a href="user/MyDetailNews.php?nid='.$row[newsid].'" title="'.$row[title].'">'.mb_substr($row[title],0,12,'utf-8').'</a>'.$editNews.'<span style="float:right">'.date('Y-m-d',$row[addTime]).'</span></li>'."<hr>";

}

?>
</div>

<!--这是NewsText的结尾-->




</div><!--这是overflow的结尾-->
</div><!--这是newsdiv的结尾-->


<div class="copyright">Copyright &copy; 2016 All Rights Reserved 作者:Mike 版权所有，盗版必究</div>
</body>

<script language="javascript" type="text/javascript" src="js/AdPPT.js"></script>
<script language="javascript" type="text/javascript" src="js/TimeAndDate.js"></script>



<script language="javascript" type="text/javascript">
//全选
function SelectAll(obj){
	var cboes=document.getElementsByName("cbonewsid");
		for(var i=0;i<cboes.length;i++){
			cboes[i].checked=obj.checked;
		}
}
		
//批量删除
function DeleteByNewsIds(){
	var newsids="";//批量删除的新闻ID
	var cboes=document.getElementsByName("cbonewsid");
		for(var i=0;i<cboes.length;i++){
			if(cboes[i].checked)
			newsids+=cboes[i].value+",";
		}
		if(newsids.length==0)
		 alert("请至少选择一条要删除的记录");
			else{
		//去掉最后一个逗号
		newsids=newsids.substr(0,newsids.length-1);
		//发送到删除页面
		window.location.href="dodeletenews.php?nid="+newsids;
			}
}





//修改被选中的记录。
function AlterSelected(){
	var newsids="";//批量删除的新闻ID
	var cboes=document.getElementsByName("cbonewsid");
	for(var i=0;i<cboes.length;i++){if(cboes[i].checked){newsids+=cboes[i].value+",";}}
	if(newsids.length==0){alert("请选择要修改的记录");}
	if(newsids.length>=2){alert("一次只能修改一条记录");}
	
}







		
		

</script>
</html>
