//检测是否是包含非法字符，非法返回true，合法返回false。
//str需要检测的字符串
//isSpace=true空格作为非法字符，false不作
function CheckIsSafeStr(str,isSpace){
str=str.toLowerCase();
var result=false;
var arr=new Array(";","<",">","#","-","//"," nms "," user ");
//空格作为非法字符处理
if(isSpace && str.indexOf(" ")!=-1)
arr.push(" ");
for(var i=0;i<arr.length;i++){
	if(str.indexOf(arr[i])!=-1){
	result=true;
	break;
		}
	}
return result;
}