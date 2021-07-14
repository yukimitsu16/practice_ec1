<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>農園</title>
</head>
<body>
<?php include('../include/nav.php');?>
<link rel="stylesheet" href="../css/etc.css">
<header>
</header>
<article>
<?php

try
{

require_once('./common.php');

$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal=$post['postal'];
$address=$post['address'];
$tel=$post['tel'];
$pass=$post['pass'];
$danjo=$post['danjo'];
$birth=$post['birth'];

print $onamae.'様<br />';
print 'ご登録ありがとうございました。<br />';
print $postal.'<br />';
print $address.'<br />';
print $tel.'<br />';


$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql='INSERT INTO dat_member (password,name,email,postal,address,tel,danjo,born) VALUES (?,?,?,?,?,?,?,?)';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=md5($pass);
	$data[]=$onamae;
	$data[]=$email;
	$data[]=$postal;
	$data[]=$address;
	$data[]=$tel;
	if($danjo=='dan')
	{
		$data[]=1;
	}
	else
	{
		$data[]=2;
	}
	$data[]=$birth;
	$stmt->execute($data);

	//header("Location: $next");
	$sql='SELECT LAST_INSERT_ID()';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	$lastcode=$rec['LAST_INSERT_ID()'];
	
	session_start();
	$_SESSION['member_login']=1;
	$_SESSION['member_code']=$lastcode;
	$_SESSION['member_name']=$onamae;

$dbh=null;

//print '<br />';
//print nl2br($honbun);
}
catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>
<?php

?>
<br />
<a href="shop_list.php">商品画面へ</a>
</article>
<?php include('../include/footer.php');?>
</body>
</html>