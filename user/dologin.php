<?php
session_start();
if(@$_POST['loginid'] && @$_POST['pwd'] && @$_POST['chn']){
$chn=$_POST['chn'];
//echo $chn."|".$_SESSION['check_checks'];
//return;
//验证码比对
if(strtolower($chn)!=strtolower($_SESSION['check_VC']))
die("<script>alert('验证码错误');window.history.back();</script>");
$loginid=$_POST['loginid'];
$pwd=$_POST['pwd'];
$sql="select user.*,rolename from user,role where user.roleid=role.roleid and loginid='$loginid'";
//判断用户名是否正确
include_once('../mysql/MysqlHelper.php');
$result=Execute($sql);
if($result && mysql_num_rows($result)==0)//注意条件
echo "<script>alert('用户名错误');window.history.back();</script>";
else{
//判断密码是否正确
$row=mysql_fetch_array($result,MYSQL_ASSOC);
if(strrev($row['pwd'])!=md5($pwd))
echo "<script>alert('密码错误');window.history.back();</script>";
else
{
//登录成功
//保存数据
session_start();
$_SESSION['user']=$row;

//判断是否使用COOKIE保存登录状态
if(@$_POST['cboremeber'])
setcookie("loginid",$loginid,time()+5*60,'/');

//跳转
header('location:../AdPPT.php');
		}
	}
}
else
header('location:login.php');
?>