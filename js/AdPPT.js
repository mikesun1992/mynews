// JavaScript Document
//定义一个3行5列的数组。
var arr=[["img/p1.jpg","img/p2.jpg","img/p3.jpg","img/p4.jpg","img/p5.jpg"],//这是电影海报图片。
			["https://v.qq.com/x/cover/1jx00d87vzuv04a.html?vid=n0013y9iw20",
			"http://vip.iqiyi.com/20110731/3ed4e4c1009f945e.html?vfm=2008_aldbd&fc=828fb30b722f3164&fv=p_02_01",
			"https://v.qq.com/x/cover/90d1e0gbf2eineh.html?ptag=baidu_aladdin.movie.pay",
			"http://www.iqiyi.com/v_19rrmfx1z8.html?vfm=2008_aldbd&fc=828fb30b722f3164&fv=p_02_01",
			"http://www.iqiyi.com/v_19rrn2b5nw.html?vfm=2008_aldbd&fc=828fb30b722f3164&fv=p_02_01"],//这是电影图片对应的播放链接。
			["点击观看电影：《地心引力》","点击观看电影：《变形金刚》","点击观看电影：《霍比特人》","点击观看电影：《美国队长3：内战》","点击观看电影：《雷神》"]];//这是悬停提示的信息。



var i=0;//定义轮番播放的索引。
var Link=document.getElementById("Link");//定义并获取链接标签。
var ImgTarget=document.getElementById("ImgTarget");//定义并获取图片对象。
//初始。
function Init(i){
    ImgTarget.src=arr[0][i];
	Link.href=arr[1][i];
	Link.title=arr[2][i];
	var xdivs=document.getElementsByName("xdiv[]");
		for(j=0;j<xdivs.length;j++){
			if(i==j){xdivs[j].style.display= "block";}
				else{xdivs[j].style.display= "none";}
		}
}

function Play(){
	Init(i);
    i++;
	if(i>=5){i=0;}
	
	
}
//向右翻看。
function TurnRight(){
	if(i<5){Init(i);i++;}
	else{i=0;Init(i);}
}

//向左翻看。
function TurnLeft(){
	if(i>0){i--;Init(i);}
	else{i=4;Init(i);}
}






function ArrowAppear(){
	var leftarrow=document.getElementById("leftarrow");
	var rightarrow=document.getElementById("rightarrow");
	leftarrow.style.display= "block";
	rightarrow.style.display= "block";
	

}
function ArrowDisappear(){
	var leftarrow=document.getElementById("leftarrow");
	var rightarrow=document.getElementById("rightarrow");
	leftarrow.style.display= "none";
	rightarrow.style.display= "none";
	

}
function startTime() {
				var today = new Date();
				var h = today.getHours();
				var m = today.getMinutes();
				var s = today.getSeconds();
				m = checkTime(m);
				s = checkTime(s);
				document.getElementById('txt').innerHTML =
				h + ":" + m + ":" + s;
				var t = setTimeout(startTime, 500);
				}
				function checkTime(i) {
				if (i < 10) {i = "0" + i}; // add zero in front of numbers < 10
				return i;
			}


var timer=setInterval("Play()",1500);
