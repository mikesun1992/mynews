<?php
if(@$_POST['loginid'] && $_POST['pwd'] && $_POST['repwd'] && $_POST['uname'] && $_POST['ucolor']){

$loginid=addslashes($_POST['loginid']);
$pwd=addslashes($_POST['pwd']);
$repwd=addslashes($_POST['repwd']);
$uname=addslashes($_POST['uname']);
$sex=$_POST['sex'];
$ucolor=$_POST['ucolor'];

$describe=addslashes($_POST['describe']);
//生日
$ubirthday=strtotime($_POST['ubirthday']);

if(CheckInputText($loginid,'用户名'))
return;//exit()
if(CheckInputText($pwd,'密码'))
return;
if($repwd!=$pwd)
die('密码与确认密码不一致');
if(CheckInputText($uname,'昵称'))
return;
if($ucolor=='0')
die('请选择一个喜欢的颜色');
if(count($_POST["cbof"])==0)
die('请至少选择一个爱好');
if($describe!='' && strlen($describe)>256)
die('个人简介不得超出256个字符');

//用户头像
$huimg='../images/nophoto.jpg';
if(@$_POST['huimg'])
$huimg=$_POST['huimg'];

//爱好
$cbof='';
foreach($_POST["cbof"] as $v){
$cbof.=$v.',';
}
//去掉最后一个逗号
$cbof=substr($cbof,0,strlen($cbof)-1);

include_once('../mysql/MysqlHelper.php');
//已经注册的帐号不得注册 注意SQL语句优化
$sql="select 1 from user where loginid='$loginid'";
if(mysql_num_rows(Execute($sql))==1)
die("<script>alert('用户名已存在，请重新输入');window.location.href='register.html';</script>");

//密码多次加密：第一次不可逆，最后一次可逆
$pwd=strrev(md5($pwd));




//注册成功
$sql="insert into user(userID,loginid,pwd,userName,userSex,userColor,userBirthday,userImage,userFavorite,userDescribe,roleID) values(null,'$loginid','$pwd','$uname','$sex','$ucolor','$ubirthday','$huimg','$cbof','$describe',2)";
include_once('../mysql/MysqlHelper.php');
if(Execute($sql))
echo "<script>alert('注册成功，请登录');window.location.href='login.php';</script>";

}
/*
Describe:验证文本框/域是否正确
Paramters:$input为输入的值
Return:正确返回false，错误返回true

*/
function CheckInputText($input,$msg){
$result=true;
if($input=='')
echo $msg.'为空';
elseif(strlen($input)<4 || strlen($input)>16)
echo $msg.'长度在4~16个字符以内';
else
$result=false;
return $result;
}
?>