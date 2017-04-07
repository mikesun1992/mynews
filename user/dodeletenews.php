
<?php
if(@$_GET['nid']){
$nid=$_GET['nid'];
include_once('../mysql/MysqlHelper.php');
//先删除外键表
//先读取回复ID，删除回复再来删除新闻
$sql="select ReplyID from NewsReplies where newsid in($nid)";
$result=Execute($sql);
$replyids='';//需要删除的回复ID
while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
$replyids.=$row['ReplyID'].',';
}
//去掉最后一个逗号
if(strlen($replyids)>0)
$replyids=substr(0,strlen($replyids)-1);

//删除回复
Execute("delete from NewsReplies where newsid in($nid)");
Execute("delete form reply where replyid in($replyids)");

$sql="delete from news where newsid in($nid)";
if(Execute($sql))
echo "<script>alert('删除成功');window.location.href='../AdPPT.php';</script>";
}
else
header('location:../AdPPT.php');
?>



