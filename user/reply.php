<?php
session_start();//开启SESASION。
if($_SESSION['user']!=''){
	$user=(object)$_SESSION['user'];
	$userrolename=$user->rolename;
}
?>

<?php
include_once("../mysql/MysqliHelper.php");
$nid=$_REQUEST["nid"];//新闻id
//修改恢复状态或执行删除操作。
if($_GET["rid"]){
$rid=$_GET["rid"];
$rs=$_GET["rs"];
$sql="update reply set replystatus=$rs where replyid=$rid";	
	if($rs==2){
		$sql="delete from NewsPeplies where replyid=$rid and newsID=$nid;delete from reply where replyid=$rid";
		ExecuteMultisql($sql);
	}
	ExecuteSQL($sql);
}
//发布回复。
if($_POST["replycontent"] && $_POST["chn"]){
	$chn=$_POST["chn"];
	
	if(strtolower($chn)!=strtolower($_SESSION['check_VC']))
die("<script>alert('验证码错误');window.history.back();</script>");
	
	$rc=$_POST["replycontent"];//回复的内容。
	$rt=time()+8*3600;//回复的时间。
	$userid=$user->userid;
	if($_SESSION["user"]=='')
	die("<script>alert('请先登录');parent.location.href='login.php';</script>");
	$sql="insert into Reply(replyID,replyContent,replyTime,replyStatus,userID) values (null,'$rc',$rt,1,$userid);select @@identity";
	$irid=ExecuteArr($sql)[0];//发布的回复id
	//插入新闻回复表。
	$sql="insert into NewsReplies(nrID,newsID,ReplyID) values (null,$nid,$irid)";
	ExecuteSQL($sql);		
}

$sql="select loginid,username,replytime,userImage,replyContent,userDescribe,replyStatus,reply.replyID from user,reply,NewsReplies where user.userid=reply.userid and reply.replyID=NewsReplies.replyID and newsid=$nid";

$replyarr=ExecuteSQL($sql);
if(count($replyarr)){
	foreach($replyarr as $v){
		//屏蔽的回复内容。
		$rcontent=$v['replyContent'];
		if(@!$v['replyStatus'])
		$rcontent="<font style='background-color:yellow; color:black; font-weight:bold;'>*该条回复被屏蔽*</font>";

//管理员具有屏蔽、恢复、删除回复权限
$replyrights='';
if(substr_count($userrolename,'管理员'))
$replyrights="<a href='reply.php?rid=$v[replyID]&rs=0&nid=$nid' target='if1'><font color='yellow'>屏蔽</font></a>
    <a href='reply.php?rid=$v[replyID]&rs=1&nid=$nid' target='if1'><font color='green'>恢复</font></a>
    <a href='javascript:if(confirm(\"确定要删除吗？\"))window.location.href=\"reply.php?rid=$v[replyID]&rs=2&nid=$nid\";' target='if1'><font color='red'>删除</font></a>";

echo "<table width='1160' height='250' style='border:1px solid black; border-radius:10px'>
<tr>
<td width='150' rowspan='2'><img width='140px' height='140px' src='$v[userImage]' /><hr></td>
<td width='169' height='70'><font style='font-weight:bold'>用户名:</font>$v[loginid]<hr></td>
<td width='839'><font style='font-weight:bold'>个人简介:</font>$v[userDescribe]<hr></td>
</tr>
  <tr>
  <td height='82'><font style='font-weight:bold'>昵称:</font></font>$v[username]<hr></td>
  <td><font style='font-weight:bold'>发布时间:</font>".date('Y-m-d H:i:s',$v['replytime'])." $replyrights<hr></td>
  </tr>
   <tr>
   <td height='100' colspan='3' style='overflow:auto;'><font size='+2' style='font-weight:bold'>发表内容：</font><div >$rcontent</div></td>
  </tr><hr  color='yellow' style='margin-top:50px; border:1px dashed black'>
</table>";
	}
}

?>
<form action="reply.php" method="post" target="if1">
  <tr>
    <td colspan="3">
    <textarea name="replycontent" id="replycontent" style="width:1100px; margin-top:50px" rows="8" placeholder="在此可以发表您的观点"></textarea><br />
    <font style='font-weight:bold'>请输入验证码：</font><input name="chn" id="chn" /><img src="VerificationCode.php" onclick="ChangeCheckNumber(this)" style="cursor:pointer;" title="点击切换"/><font color="#FF0000">（看不清？点击图片切换）</font>
    <input type="hidden" id="nid" name="nid" value="<?php
    echo $nid;
	?>" />
    </td>
  </tr>
  <tr>
    <td colspan="3"><input type="submit" value=" 发 布 " onclick="return CheckInput();" /></td>
  </tr>
  </form>
</table>


<script language="javascript" type="text/javascript">
//检测回复信息
function CheckInput(){
var result=false;
var replycontent=document.getElementById("replycontent");
var chn=document.getElementById("chn");
if(replycontent.value.length==0)
{
alert("请输入回复内容");
replycontent.focus();
	}
else if(chn.value.length==0){
alert("请输入验证码");
chn.focus();
	}
else{
//处理回复内容
replycontent.value=parent.DoSafeStr(replycontent.value);
result=true;
	}
return result;
}


//点击切换验证码
function ChangeCheckNumber(obj){
//URL重写过程中必须让值不一样才可以

obj.src="VerificationCode.php?a="+new Date().toLocaleString();
}
</script>


