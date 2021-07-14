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

<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	print 'ようこそゲストさん　';
	print '<a href="member_login.html">会員ログイン</a><br />';
	print '<br />';
}
else
{
	print 'ようこそ';
	print $_SESSION['member_name'];
	print '様　';
	print '<a href="member_logout.php">ログアウト</a><br />';
	print '<br />';
}
?>
</header>
<article>

<?php

try
{

$pro_code=$_GET['procode'];

if(isset($_SESSION['cart'])==true)
{
	$cart=$_SESSION['cart'];
	$kazu=$_SESSION['kazu'];

if(in_array($pro_code,$cart)==true)
{
	print'その商品はすでにカートに入っています。<br/>';
	print'<a href="shop_list.php">商品一覧に戻る</a>';
	exit();
}
}
$cart[]=$pro_code;
$kazu[]=1;
$_SESSION['cart']=$cart;
$_SESSION['kazu']=$kazu;
}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

カートに追加しました。<br />
<br />
<?php
	if(isset($_SESSION["member_login"])==true){
		print'<a href="shop_kantan_check.php">レジへ進む</a><br/>';
	}else{
		print'<a href="shop_form.html">レジへ進む</a><br/>';
	}
?>
<a href="shop_cartlook.php">カート内編集</a><br/>
<a href="shop_list.php">商品一覧に戻る</a>
</article>
<?php include('../include/footer.php');?>
</body>
</html>