<?php

try
{

$member_email=$_POST['email'];
$member_pass=$_POST['pass'];

$member_email=htmlspecialchars($member_email,ENT_QUOTES,'UTF-8');
$member_pass=htmlspecialchars($member_pass,ENT_QUOTES,'UTF-8');

$member_pass=md5($member_pass);

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name FROM dat_member WHERE email=? AND password=?';
$stmt=$dbh->prepare($sql);
$data[]=$member_email;
$data[]=$member_pass;
$stmt->execute($data);

$dbh=null;

$rec=$stmt->fetch(PDO::FETCH_ASSOC);

if($rec==false)
{
	print 'メールアドレスかパスワードが間違っています。<br />';
	print '<a href="member_login.php"> 戻る</a>';
}
else
{
	session_start();
	$_SESSION['member_login']=1;
	$_SESSION['member_code']=$rec['code'];
	$_SESSION['member_name']=$rec['name'];
	header('Location:shop_list.php');
	exit();
}

}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>