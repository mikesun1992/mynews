// JavaScript Document
//图片随机飘动。
var x=y=0;//初始图片位置的坐标。x，y都是0
var movetime=10;//每多少毫秒移动一次。
var movelength=1;//每次移动的长度（像素）。
var xtrue=ytrue=true;//控制跑动的方向true从左往右、从上往下.


//初始化广告图片的位置。
function InitialPosition(){
	var div1=document.getElementById("div1");
		div1.style.left=x+"px";//初始位置，图片距离left的距离。
		div1.style.top=y+"px";//初始位置，图片距离top的距离。
					
}

//移动效果。
function MoveEffect(){
	var div1=document.getElementById("div1");
		div1.style.left=x+"px";//初始位置，图片距离left的距离。
		div1.style.top=y+"px";//初始位置，图片距离top的距离。
	var W=document.body.offsetWidth-div1.offsetWidth;//获取的是网页可见区域的宽度（包括了边线的宽）。
	var H=document.body.offsetHeight-div1.offsetHeight;//获取的是网页可见区域的高度（包括了边线的宽）。
		x+=(xtrue?1:-1)*movelength;//三元运算符。？：用法：如果问号前面的条件成立就执行冒号前面的，不然就执行冒号后面的。
		y+=(ytrue?1:-1)*movelength;//这里括号结果是1或者-1，这样的话乘上movelength后得到的值，让y可以不断的加上。
		
if(x>=W){xtrue=false;}
if(x<=0){xtrue=true;}
if(y>=H){ytrue=false;}
if(y<=0){ytrue=true;}	
			

}

var timer=setInterval("MoveEffect()",movetime);