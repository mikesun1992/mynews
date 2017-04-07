<?php
//！！！注意了，这里的<?php 必须顶格写，前面不能有空格或者其他任何东西，不然会出现乱码。
session_start();
$_SESSION['check_VC']=CodeCreate(4);
header("content-type:image/jpeg");//一：声明。
$im_width=125;//定义变量设置画布的宽度。
$im_height=40;//定义变量设置画布的高度。
$im=imagecreate($im_width,$im_height);//二：创建画布及其定义尺寸。
imagecolorallocate($im,245,245,245);//设置画布的颜色。

//for循环设置干扰线条数
for($i=0;$i<10;$i++){
	$linecolor=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));//定义干扰线颜色（随机）。
		$a=imageline($im,0,rand(0,$im_height),$im_width,rand(0,$im_height),$linecolor);
}

//for循环设置干扰点的个数。
for($i=0;$i<100;$i++){
	$pixelcolor=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));//定义干扰点颜色（随机）。
		imagesetpixel($im,rand(0,$im_width),rand(0,$im_height),$pixelcolor);//画点
}

$color=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));//定义验证码颜色（随机）。
$font="TEMPSITC.TTF";//字体文件（注意路径问题）
imagettftext($im, 30,0,5,30,$color,$font,$_SESSION['check_VC']);//画出验证码的。

imagejpeg($im);//三：生成图片。

imagedestroy($im);//四：销毁材料，释放资源。


//生成随机数的函数。
function CodeCreate($count){//$count是用来设置生成的验证码位数的
	$str="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWSYZ0123456789";
		for($i=0;$i<$count;$i++){
			$checknum.=substr($str,rand(0,strlen($str)-1),1);//这个“.=”不能少！
		}
			return $checknum;
}











/************************************************************************************************************
开启GD2步骤提要：
1.在php5文件夹中的配置文件php.ini中，查找到extension=php_gd2.dll,并将前面的分号（;）去掉，保存修改后的php.ini。
2.在php5中的ext文件夹中找到php_gd2.dll。
3.将php.ini和php_gd2.dll文件复制到C盘的Windows文件夹中，再重启Apache服务器。
4.通过phpinfo()(php探针)查询gd2是否开启成功。

常用的GD2函数：
*画线：imageline
*画点：imagesetpixel
*画矩形：imagerectangle
*画圆：imageellipse
*画实心矩形：imagefilledrectangle
*画实心圆：imagefilledellipse
*画文字（不支持中文）：imagestring
*画竖排文字：imagestringup
*画中文文字：imagettftext

PS：所有的绘画工作完成后，可以使用img标签进行调用！！！
    <img src="xxx.php">

**************************************************************************************************************/




?>
