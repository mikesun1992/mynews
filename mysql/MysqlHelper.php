<?php
include_once('config.inc.php');

/*
Describe:操作数据库四大步
Paramters:$sql需要执行的任何SQL语句
Return:查询返回结果集；添加修改删除返回影响行数
*/
function Execute($sql){
$con=@mysql_connect(HOST,USER,PWD) or die('亲，服务器忙，请稍后访问');
@mysql_select_db(DB) or die('数据库'.DB.'不存在');
//加上执行编码
mysql_query('set names utf8');
$result=mysql_query($sql);
mysql_close($con);
return $result;
} 
?>