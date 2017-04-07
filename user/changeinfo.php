<?php
session_start();//取值也需要开启
$user=(array)$_SESSION['user'];//取出用户登录信息判断身份
$formerpwd=addslashes($_POST['formerpwd']);//获取的用户输入的原密码。
//判断输入的密码和原密码是否一样。
if(md5($formerpwd)!=strrev($user['pwd'])){echo "<script>alert('原密码错误！');window.history.back(1);</script>";}

else{
//loginid（用户名）就不需要获取了。因为要修改的就是该用户名下的信息。
$pwd=addslashes($_POST['pwd']);
$repwd=addslashes($_POST['repwd']);
$uname=addslashes($_POST['uname']);
$sex=$_POST['sex'];
$ucolor=$_POST['ucolor'];
$describe=addslashes($_POST['describe']);
$ubirthday=strtotime($_POST['ubirthday']);//生日需要转换为时间戳，从而让它变成int类型。

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
$huimg='images/nophoto.jpg';
if(@$_POST['huimg'])
$huimg=$_POST['huimg'];

//爱好
$cbof='';
foreach($_POST["cbof"] as $v){
$cbof.=$v.',';
}
//去掉最后一个逗号
$cbof=substr($cbof,0,strlen($cbof)-1);



//最后将密码进行MD5加密再倒序处理得到一串32位的字符串，将此字符串作为密码保存数据库。等登录的将输入密码MD5处理后再与数据库中strrev后的密码进行比对。
$pwd=strrev(md5($pwd));


//所谓修改就是要update，所以要写SQL语句让它执行。这里要修改的信息where的判断依据就是通过用户名。
$sql="update user set pwd='$pwd',userName='$uname',userSex='$sex',userColor='$ucolor',userBirthday='$ubirthday',userImage='$huimg',userFavorite='$cbof',userDescribe='$describe' where loginid='$user[loginid]'";
include_once('../mysql/MysqlHelper.php');

if(Execute($sql))

echo "<script>alert('修改成功，请重新登录');window.location.href='login.php';</script>";

}


/**************************************
Describe:验证文本框/域是否正确
Paramters:$input为输入的值
Return:正确返回false，错误返回true

****************************************/

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