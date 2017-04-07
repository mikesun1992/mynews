//验证用户输入
function CheckInput(){
var result=false;
//获取用户名文本框对象
var loginid=document.getElementById("loginid");
var formerpwd=document.getElementById("formerpwd");
var pwd=document.getElementById("pwd");
var repwd=document.getElementById("repwd");
var uname=document.getElementById("uname");
var ucolor=document.getElementById("ucolor");
var describe=document.getElementById("describe");
var ubirthday=document.getElementById("ubirthday");
var cbof=document.getElementsByName("cbof[]");

if(CheckIsSafeInputText(formerpwd,"原密码")){}


else if(CheckIsSafeInputText(loginid,"用户名")){}
else if(CheckIsSafeInputText(pwd,"密码")){}
else if(repwd.value!=pwd.value){
alert("密码与确认密码不一致");
repwd.focus();
	}
else if(CheckIsSafeInputText(uname,"昵称")){}
else if(ucolor.value=="0"){
alert("请至少选择一个喜欢的颜色");
ucolor.focus();
	}
else if(ubirthday.value.length==0){
alert("请选择生日");
ubirthday.focus();
	}
else if(CheckFavorite(cbof)){
	alert("请至少选择一个爱好");
	cbof[0].focus();
	}
else if(describe!=null && describe.value.length>256){
alert("个人简介不得超出256个字符");
describe.focus();
	}
else if(describe!=null && CheckIsSafeStr(describe.value,false)){
alert("个人简介不得包含非法字符");
describe.focus();	
	}
else
	//document.getElementById("form1").submit();
	result=true;
return result;
}

//爱好验证 只要有一个被选中返回false，都没有被选中返回true
function CheckFavorite(obj){
for(var i=0;i<obj.length;i++){
	if(obj[i].checked)
	return false;
	}
return true;
}

//验证文本框是否合法，非法返回true，合法返回false
function CheckIsSafeInputText(obj,msg){
var result=true;
if(obj==null || obj.value=="")
{
alert(msg+"不得为空");//+为字符串连接符
obj.focus();
	}
else if(obj.value.length<4 || obj.value.length>16){
alert(msg+"长度在4~16个字符以内");
obj.focus();
	}
else if(CheckIsSafeStr(obj.value,true)){
alert(msg+"不得包含空格等非法字符");
obj.focus();
	}
else
	result=false;
return result;
}

//回车验证
function EnterCheck(e){
var e=e || window.event;
if(e.keyCode==13)
	CheckInput();
}

//上传图片验证
function CheckUploadImg(obj){
var fileExtension=obj.value.substr(obj.value.lastIndexOf(".")).toLowerCase();
if(fileExtension!=".jpg" && fileExtension!=".gif" && fileExtension!=".png" && fileExtension!=".bmp"){
alert("仅支持jpg/gif/png/bmp图片格式上传");
obj.outerHTML=obj.outerHTML;//清空上传地址
	}
else
document.getElementById("ulform").submit();
}

//上传回调
function CallBack(path){
document.getElementById("imguser").src=path;//显示上传图片
//保存上传图片地址，用于用户注册
document.getElementById("huimg").value=path;
//保存上传图片地址，用于用户上传图片后继续上传删除原来的图片
document.getElementById("hureimg").value=path;
}