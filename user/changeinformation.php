<?php
session_start();//取值也需要开启
$user=(array)$_SESSION['user'];//取出用户登录信息判断身份
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改用户信息</title>
<style>
.copyright{ margin-left:auto; margin-right:auto; text-align:center; margin-top:30px; font-size:18px; color:#FFFFFF}
.upimg{position:absolute; width:150px; height:150px; border:1px solid gray; left: 992px; top: 90px;}
.returntologinbutton{ height:25px; text-align:right; margin-right:50px;}
</style>
<script language="javascript" type="text/javascript" src="../js/common.js"></script>
<script language="javascript" type="text/javascript" src="../js/changeinfo.js"></script>
<script language="javascript" type="text/javascript" src="../My97DatePicker/WdatePicker.js"></script>
</head>
<body style=" background-image:url(../img/changeinfobg.jpg)">
<div  class="returntologinbutton" >
<input  type="button" value="返回登录" onClick="window.location.href='login.php';"/>&nbsp;&nbsp;&nbsp;<input  type="button" value="返回首页" onClick="window.location.href='../AdPPT.php';"/></div>
<form name="form1" id="form1" action="changeinfo.php" method="post">
<table width="400px"; height="550px" style="border:1px solid black;Box-shadow:inset 0 0 10px red; background-color:#CCCCCC;opacity:0.8; border-radius:20px" align="center" >
<caption><font style="font-family:'幼圆'"><h1>用 户 信 息 修 改</h1></font></caption>

<tr><th>用户名：</th><td><input type="text" name="loginid" id="loginid"  value="<?php echo $user['loginid']?>"  readonly="readonly"></td></tr>
<tr><th>原密码：</th><td><input type="password" name="formerpwd" id="formerpwd" placeholder="请输入原密码" onKeyDown="EnterCheck(event);"></td></tr>
<tr><th>新密码：</th><td><input type="password" name="pwd" id="pwd" placeholder="请输入新密码" onKeyDown="EnterCheck(event);"></td></tr>
<tr><th>确认密码：</th><td><input type="password" name="repwd" id="repwd" placeholder="请确认密码" onKeyDown="EnterCheck(event);"><td></tr>
<tr><th>昵称：</th><td><input type="text" name="uname" id="uname" value="<?php echo $user['userName']?>" onKeyDown="EnterCheck(event);"></td></tr>
<tr><th>性别：</th><td><input type="radio" name="sex" id="sex" checked="checked" value="男"  <?php if($user['userSex']=='男'){echo 'checked';}?>/>男<input type="radio" name="sex" id="sex" value="女" <?php if($user['userSex']=='女'){echo 'checked';}?>/>女</td></tr>
<tr><th>生日：</th><td><input class="Wdate" type="text" id="ubirthday" name="ubirthday" onFocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd'})" value="<?php echo date('Y-m-d',$user['userBirthday'])?>"/></td></tr>
<tr><th>喜欢的颜色：</th><td>
<select name="ucolor" id="ucolor"><option selected>===请选择===</option>
		<option value="红色"  <?php if($user['userColor']=='红色')echo 'selected';?>>===红色===</option>
        <option value="绿色"  <?php if($user['userColor']=='绿色')echo 'selected';?> >===绿色===</option>
        <option value="蓝色" <?php if($user['userColor']=='蓝色')echo 'selected';?>>===蓝色===</option>        
</select></td></tr>
<tr><th>爱好：</th><td><input type="checkbox" name="cbof[]" id="cbof[]"  value="看电影" <?php if($user['userFavorite']=='看电影'){echo 'checked';}?>   />看电影<input type="checkbox" name="cbof[]" id="cbof[]" value="听音乐" <?php if($user['userFavorite']=='听音乐'){echo 'checked';}?> />听音乐<input type="checkbox" name="cbof[]" id="cbof[]" value="玩游戏" <?php if($user['userFavorite']=='玩游戏'){echo 'checked';}?> />玩游戏</td></tr>


<tr><th>个人简介：</th><td><textarea rows="5" name="describe" id="describe"  onKeyDown="EnterCheck(event);"><?php echo $user['userDescribe']?></textarea>
<!--用户头像-->
<input type="hidden" id="huimg" name="huimg">
</td></tr>
<tr><td></td><td><input type="submit" value="提交" onClick="return CheckInput();"/>
                 <input type="reset" value="重置"  />
                 <input type="button" value="取消" onClick="window.location.href='login.php';"/>
</td></tr>
</table>
</form>
<form action="../upload.php" method="post" enctype="multipart/form-data" name="ulform" id="ulform" target="if1">
<div  class="upimg"  align="center">
<img src="../img/nophoto.jpg" name="imguser" id="imguser" width="150px" height="150px">
<br>
<!--用户头像-->
<input type="hidden" id="hureimg" name="hureimg">
<input name="fu1" id="fu1" type="file" onKeyDown="return false;" onChange="CheckUploadImg(this);">
</div>
</form>
<iframe name="if1" id="if1" height="0px" width="0px" style="border:none; display:none;" scrolling="no"></iframe>



<div class="copyright">Copyright &copy; 2016 All Rights Reserved 作者:Mike 版权所有，盗版必究</div>

</body>
</html>
