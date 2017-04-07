<?php
session_start();//开启SESSION
//获取服务器绝对路径。
$path=$_SERVER['DOCUMENT_ROOT'];//这里echo出来是：D:/wwwroot
$path.='/';
if(strrpos($path, '/')!=strlen($path)-1){$path.='/';}//回忆一下".="的含义

if(@$_COOKIE['loginid']){$loginid=$_COOKIE['loginid'];

$sql="select user.*,rolename from user,role where user.roleid=role.roleid and loginid='$loginid'";
require_once($path."MyNews/mysql/MysqlHelper.php");
$result=Execute($sql);
$row=mysql_fetch_array($result,MYSQL_ASSOC);
$_SESSION['user']=$row;

}

?>
