<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<title>新闻资讯页面</title>
<style>
.newsbigdiv{width:1200px;height:500px;border:1px solid white; margin-left:auto; margin-right:auto; background-color:#000000;opacity:0.8; border-radius:10px; margin-top:20px;}
.h1div{text-align:center; color:#FFFFFF; font-family:'叶根友毛笔行书2.0版';}
.copyrightdiv{text-align:center; margin-top:50px; color:#FFFFFF;}
.newstextdiv{ width:900px;height:430px; margin-left:auto;margin-right:auto;overflow-y:auto;background-color:#FFFFFF;}
.commentandreply{width:1200px; height:500px;border:1px solid white;border-radius:10px; margin-left:auto; margin-right:auto; background-color:#000; opacity:0.9;}
</style>
</head>

<body onLoad="startTime()" style="background-image:url(../img/detailnewsbg.jpg);">
	
<div  class="h1div"><h1>我 的 电 影 资 讯</h1></div>
<div style="text-align:right; margin-right:50px;"><input type="button" value="返回首页" onClick="window.location.href='../AdPPT.php'">&nbsp;&nbsp;&nbsp;<input type="button" value="登录/注册" onClick="window.location.href='login.php'"></div>
	
<?php
if(@$_GET['nid']){
$nid=$_GET['nid'];
$sql="select title,content,addtime,clickcount,username from news,user where news.userid=user.userid and newsid=$nid";
include_once('../mysql/MysqlHelper.php');
$result=Execute($sql);
$row=mysql_fetch_array($result,MYSQL_ASSOC);
//修改点击率每次访问加1
$sql="update news set clickcount=clickcount+1 where newsid=$nid";
Execute($sql);
}
else
header('location:../AdPPT.php');
?>
<div class="newsbigdiv">
<div style="text-align:center;"><font size="+2" style="font-weight:bold;width:400px; word-wrap:break-word; color:#FFFFFF"><?php echo $row['title'];?></font></div>
 <div style="text-align:center; color:gray"><font size="-1" color="gray">【作者】：<?php echo $row['username'];
?> 【发布时间】：<?php echo date('Y-m-d H:i:s',$row['addtime']);?> 【点击率】：<?php echo $row['clickcount']+1;?></font></div><hr>
<div  class="newstextdiv">&nbsp;&nbsp;<?php echo stripcslashes($row['content']);?></div>
</div>



<div class="commentandreply"><iframe class="container" style="width:1200px; height:450px;margin-top:0px; background-color:#FFF; border-radius:10px;" id="if1" name="if1" src="reply.php?nid=<?php
        echo $nid;
		?>"></iframe>



</div>
		
	
<div class="copyrightdiv" ><p>Copyright &copy; 2016 All Rights Reserved 作者:Mike 版权所有，盗版必究</p></div>
		
	
</body>
</html>