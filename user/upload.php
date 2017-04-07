<?php
if(@$_FILES['fu1'] && $_FILES['fu1']['error']){
$msg='';
$error=$_FILES['fu1']['error'];//错误代码
switch($error){
case 1:$msg='超过php.ini允许的大小';break;
case 2:$msg='超过表单允许的大小';break;
case 3:$msg='图片只有部分被上传';break;
case 4:$msg='请选择图片';break;
case 6:$msg='找不到临时目录';break;
case 7:$msg='写文件到硬盘出错';break;
case 8:$msg='File upload stopped by extension';break;
case 999:
default:$msg='未知错误';break;
		}
die("<script>alert('$msg');</script>");
}
elseif($_FILES['fu1']){//上传没有错误
//判断上传文件大小是否合适，不得超出2M,建议可以放到5M
if($_FILES['fu1']['size']/1024/1024>2)
die("<script>alert('上传文件不得大于2M');</script>");

if(!file_exists("uploads"))//判断路径是否存在
mkdir("uploads",0777);//创建路径并指定权限最大777


//上传图片之前删除原来的图片
if(@$_POST['hureimg'])
@unlink(substr($_POST['hureimg'],3));


//上传文件名不得重复，否则会造成覆盖
$fileName=date('YmdHis',time()+8*3600).rand(0,9).rand(0,9).rand(0,9).$_FILES['fu1']['name'];

//上传
$result=move_uploaded_file($_FILES['fu1']['tmp_name'],"uploads/$fileName");
if($result){
die("<script>alert('上传成功');parent.CallBack('uploads/$fileName');</script>");
}

}
?>