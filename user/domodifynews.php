<?php
if(@$_POST['title'])
{
//标题和内容，事实上所有你让用户输入的内容都需要客户端和PHP端双验证
$title=addslashes($_POST['title']);//注意单双引号的处理
$content=addslashes($_POST['content']);
$now=time()+8*3600;
//添加
$sql="insert into news(newsid,title,content,addtime,clickcount,userid) values(null,'$title','$content',$now,0,1)";
include_once('../mysql/MysqlHelper.php');

$msg='添加';
//修改
if(@$_POST['nid']){
$sql="update news set title='$title',content='$content' where newsid=".$_POST['nid'];
$msg='修改';
}

if(Execute($sql))
echo "<script>alert('".$msg."成功');window.location.href='../AdPPT.php';</script>";
//header("location:index.php");
//header跳转会使弹窗失效
}
else
header('location:../AdPPT.php');
?>