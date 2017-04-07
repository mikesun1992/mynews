<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加新闻</title>
<script charset="utf-8" src="../kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="../kindeditor/lang/zh_CN.js"></script>
	<script charset="utf-8" src="../kindeditor/plugins/code/prettify.js"></script>
    <script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
				cssPath : '../kindeditor/plugins/code/prettify.css',
				uploadJson : '../kindeditor/php/upload_json.php',
				fileManagerJson : '../kindeditor/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=form1]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=form1]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>
</head>

<body style="background-image:url(../img/addbg.jpg); background-repeat:no-repeat;">
<style>
.inputtitle{
width:570px;opacity:0.8
}
</style>
<?php
//获取要修改的原信息。
if(@$_GET['nid']){
$nid=$_GET['nid'];
$sql="select title,content from news where newsid=$nid";
include_once ("../mysql/MysqlHelper.php");
$result=Execute($sql);
$row=mysql_fetch_array($result,MYSQL_ASSOC);
}


?>

<div style="text-align:center; margin-top:50px;">
<form action="domodifynews.php" method="post" name="form1" id="form1">

<font size="+2"  color="#FFFFFF";>输入新闻标题：</font><div class="newstitlediv"><input class="inputtitle" id="title" name="title"  value="<?php echo $row['title'];?>"/></div>
<font size="+2" color="#FFFFFF";>输入新闻内容：</font>
<div style="width:680px; height:500px; margin-left:auto; margin-right:auto; overflow-y:auto; opacity:0.8">
<textarea name="content" id="content" style="height:500px;visibility:hidden;"><?php $content=$row['content'];
echo htmlspecialchars($content) ?> 
</textarea>	</div>

<div style=" margin-top:20px; margin-left:auto; margin-right:auto; text-align:center; color:#FFFFFF">
<!--按钮类型必须是submit-->
<input type="submit" value=" 提 交 " onclick="return CheckInput();" />(提交快捷键: Ctrl + Enter)</div>
</form>
</div>
</body>


<script language="javascript" type="text/javascript">
//检测新闻标题是否输入
function CheckInput(){
var result=false;
var title=document.getElementById("title");
if(title.value.length==0)
{
alert("请输入新闻标题");
title.focus();
	}
else if(title.value.lenth>256){
alert("新闻标题不得超出256个字符");
title.focus();
	}
else
result=true;
return result;
}
</script>

</html>
