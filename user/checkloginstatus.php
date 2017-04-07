<?php
session_start();//取值也需要开启
$user=(array)$_SESSION['user'];//取出用户登录信息判断身份
echo "<div style='text-align:center; margin-top:5px;color:black;'>
欢迎您：【";
$usera="<a href='user/login.php'>登录</a> <a href='user/register.html'>注册</a>";
if($_SESSION['user']=='')//判断的条件还是根据SESSION
{}
else{
$usera="<a href='/demo/my/user/changeinformation.php?changeUserid=$user[userid]' onmouseover='DisplayUserInfo(event);' onmouseout='HiddenUserInfo();'>$user[userName]</a> <a href='user/loginout.php'>安全退出</a>";
}
echo $usera;
echo '】</div>';
?>




<div style="display:none; position:absolute; width:360px; text-align:left; word-wrap:word-break; border:1px solid black;color:#FFFFFF;background-color:#000000;"; id="divuserinfo" name="divuserinfo">
<img width="140px" height="140px" align="left" src="<?php echo $user['userImage'];?>"/>
【帐号】：<?php echo $user['loginid'];?><br />
【来自】：<?php echo $_SERVER['REMOTE_ADDR'];?><br />
【您使用的操作系统】：<?php echo PHP_OS;?><br />
【您使用的浏览器】：<?php echo $_SERVER['HTTP_USER_AGENT'];?><br />
【个性签名】：<?php echo $user['userDescribe'];?>
</div>
<script language="javascript" type="text/javascript">
//显示个人信息DIV
function DisplayUserInfo(e){
var e=e || window.event;
var divuserinfo=document.getElementById("divuserinfo");
divuserinfo.style.display="block";
divuserinfo.style.left=(e.clientX-divuserinfo.offsetWidth)+"px";
divuserinfo.style.top="24px";
}

//隐藏个人信息DIV
function HiddenUserInfo(){
var divuserinfo=document.getElementById("divuserinfo");
divuserinfo.style.display="none";
}
</script>