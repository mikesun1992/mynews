<?php
//根据COOKIE数据获取登录用户信息
include_once('getCookie.php');
if(@$_COOKIE['loginid'])
header('location:../AdPPT.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录页面</title>
<style>
body{font-family:"微软雅黑";background-image:url("../img/loginbg.jpg");background-repeat:no-repeat;background-position:50% 0px;}
.divtitle{width:50%;height:55px;border-bottom:1px solid gray;float:left;line-height:55px;text-align:center;}
.loginA{text-decoration:none;font-size:18px; color:black; display:block; width:76px;border-bottom:2px solid black; margin-left:55px;}
.registerA:hover{color:black;font-size:18px;}
.registerA{color:gray;text-decoration:none;font-size:16px;}
.divinput{width:304px;height:38px;float:right;margin-right:31px;text-align:right;margin-top:15px;}
.inputtext{width:216px;height:32px;}
.loginTiShi{width:304px; height:38px; border:1px solid gray; margin-top:14px; margin-left:34px; text-align:center; line-height:38px;font-size:14px;border-radius:10px}

</style>
<script language="javascript" type="text/javascript" src="../js/common.js"></script>
</head>

<body>
<form action="dologin.php" method="post" name="form1" id="form1">
<div style="width:100%; height:150px; line-height:150px; text-align:center;"><font style="font-size:36px; font-weight:bold;" color="white">欢 迎 登 录 我 的 电 影 世 界</font></div>
<div style="text-align:right; margin-right:150px;"><input  type="button" value="返回首页" onclick="window.location.href='../AdPPT.php'"/></div>
<div style="width:372px; height:424px;background-color:#FFFFFF;opacity:0.9;margin:0px auto; border-radius:20px;Box-shadow:inset 0 0 10px black;">
<div class="divtitle"><a href="#" class="loginA">登 录</a></div>
<div class="divtitle"><a href="register.html" class="registerA">注 册</a></div>
<div style="clear:left;"></div>
<div class="loginTiShi">登录请注意格式</div>

<div class="divinput">用户名：<input class="inputtext" name="loginid" id="loginid" /></div>
<div class="divinput">密码：<input class="inputtext" name="pwd" id="pwd" type="password" /></div>
<div class="divinput">验证码：<input class="inputtext" name="chn" id="chn"/></div>
<div class="divinput" align="center"><img src="VerificationCode.php"  name=""onclick="ChangeCheckNumber(this)" style="cursor:pointer;" title="点击切换" name="chnimg" id="chnimg"/><font size="-2">看不清?点击图片切换</font></div>
<div class="divinput" style="width:218px;">
<div style="height:38px;border-radius:4px;background:#2795dc;cursor:pointer;color:#fff;font-size:16px;width:140px; text-align:center; line-height:38px;border-bottom:3px solid #0078b3; float:left;" onclick="CheckLogin();">同意协议并登录</div>
<div style="float:left;height:36px; width:70px;line-height:36px; margin-left:5px;">
<input type="checkbox" /><font style="color: #959ca8; font-size:12px;">记住登录</font>
</div>
</div>
</div>
</form>
<div style="margin-top:25px; text-align:center;"><font color="#FFFFFF"> Copyright &copy; 2016 All Rights Reserved 作者:Mike 版权所有，盗版必究</font></div>
</body>
<script language="javascript" type="text/javascript">
//登录验证
function CheckLogin(){
var loginid=document.getElementById("loginid");
var pwd=document.getElementById("pwd");
var chn=document.getElementById("chn");
if(loginid.value.length==0)
{
alert("请输入用户名");
loginid.focus();
	}
else if(CheckIsSafeStr(loginid.value,true)){
alert("用户名不得包含空格等非法字符");
loginid.focus();
}
else if(pwd.value.length==0){
alert("请输入密码");
pwd.focus();
	}
else if(CheckIsSafeStr(pwd.value,true)){
alert("密码不得包含空格等非法字符");
pwd.focus();
}	
else if(chn.value.length==0){
alert("请输入验证码");
chn.focus();
}
else
document.getElementById("form1").submit();
}

//点击切换验证码
function ChangeCheckNumber(obj){
//URL重写过程中必须让值不一样才可以
/*
var chnimg=document.getElementById("chnimg");
chnimg.src="../CheckNum.php?a="+new Date().toLocaleString();
*/
obj.src="VerificationCode.php?a="+new Date().toLocaleString();
}

</script>
</html>
