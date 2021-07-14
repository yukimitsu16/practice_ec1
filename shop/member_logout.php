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
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
	setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
?>
</header>
<article>

ログアウトしました。<br />
<br />
<a href="../shop/shop_list.php">商品一覧へ</a>
</article>
<?php include('../include/footer.php');?>
</body>
</html>