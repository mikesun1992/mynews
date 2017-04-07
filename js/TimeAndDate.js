// JavaScript Document
//获取当前的本地时间
function RunTime(){
	var now=new Date();
	var year=now.getFullYear();
	var month=now.getMonth();//注意getMonth返回值是0到11，根据需要考虑+1
	var date=now.getDate();
	var day=now.getDay();//注意getDay返回值是0到6，表示星期几。根据需要考虑+1.
	var hours=now.getHours();
	var minutes=now.getMinutes();
	var seconds=now.getSeconds();
	month=addZero(month);
	date=addZero(date);
	hours=addZero(hours);
	minutes=addZero(minutes);
	seconds=addZero(seconds);
	//定义星期几的数组，一一对应上，这时getDay不用+1.
	var dayarray=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
	//定义月份的英语单词，一一对应上，这时getMonth也不要+1
	var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
//document.write(""+dayarray[day]+", "+montharray[month]+" "+date+", "+year+"");
    var timetext=document.getElementById("timetext");
	//var nowTime="北京时间："+year+"年"+month+"月"+date+"日 "+hours+":"+minutes+":"+seconds;
	var nowTime=hours+":"+minutes+":"+seconds+"<br>";
	var YNDW=dayarray[day]+","+" "+montharray[month]+" "+date+","+" "+year;
		timetext.innerHTML="<font class='fonttime'>"+nowTime+"</font>"+"<font class='fontdate'>"+YNDW+"</font>";
	//这里要体会一下innerHTML的用法和妙处。
	
}

//补零函数。因为月、日、时、分、秒返回值都是有一位数，所以为了美观要考虑补0.
function addZero(i){
		if(i<10){i="0"+i;}
			return i;
}
setInterval("RunTime()",1000);//每1000毫秒调用一次函数