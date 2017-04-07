<?php
include_once('config.inc.php');
/*
Describe:操作MYSQL数据库
Paramters:$sql任何的SQL语句,$type=1默认引用数组，$type=2索引数组
Returns:读取返回结果二维数组,添加/修改/删除返回影响行数
*/
function ExecuteSQL($sql,$type=1){
$mysqli=@new mysqli(HOST,USER,PWD);
if($mysqli->connect_error)
die('连接数据库服务器失败，请检查配置');
@$mysqli->select_db(DB) or die('访问的数据库'.DB.'不存在，请重新输入');
$mysqli->query("set names utf8");
$result=$mysqli->query($sql);
if(substr_count($sql,"select ")==0)
{
$mysqli->close();//关闭链接释放资源
return $result;
}
//$arr='';//读取返回的二维数组
if($type==1){
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
	$arr[]=$row;
	}
}
elseif($type==2){
while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
	$arr[]=$row;
	}
}
$mysqli->close();
return $arr;
}

//批量执行SQL语句
function ExecuteMultiSql($sql){
$mysqli=@new mysqli(HOST,USER,PWD);
if($mysqli->connect_error)
die('连接失败，请检查配置');
@$mysqli->select_db(DB) or die('访问的数据库'.DB.'不存在');
$mysqli->query("set names utf8");
$mysqli->multi_query($sql);
$mysqli->close();
}

/*
批量执行SQL语句 $sqls批量执行SQL语句，中间以；隔开
最后一条SQL查询返回最后一个结果集
最后一条SQL插入、修改、删除返回影响行数
*/
function ExecuteArr($sql){
//1、创建mysqli对象
$mysqli=@new mysqli(HOST,USER,PWD,DB);
$mysqli->query("set names utf8");
if($mysqli->connect_error)
die("连接失败".$mysqli->connect_error);
//2、处理结果
//如果成功，至少有一个结果集
if($res=$mysqli->multi_query($sql)){
	while($mysqli->next_result()){
		$res=$mysqli->store_result();
		//必须强制跳出循环
		if(!$mysqli->more_results())
		break;
	}
}
//3、关闭资源
$mysqli->close();
return mysqli_fetch_array($res);
} 
?>