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
    print'ようこそゲストさん';
    print'<a href="member_login.html">会員ログイン</a>';
    print'<br/>';
}
else{
    print'ようこそ';
    print $_SESSION['member_name'];
    print '様';
    print'<a href="member_logout.php">ログアウト</a>';
    print '<br/>';
}
?>
</header>
<article>
<?php

try
{

$pro_code=$_GET['procode'];

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT name,price,gazou,weight,deadline,save,product,free FROM mst1_product WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];
$pro_gazou_name=$rec['gazou'];
$pro_weight=$rec['weight'];
$pro_deadline=$rec['deadline'];
$pro_save=$rec['save'];
$pro_product=$rec['product'];
$pro_free=$rec['free'];

$dbh=null;

if($pro_gazou_name=='')
{
	$disp_gazou='';
}
else
{
	$disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
}
print'<a href="shop_cartin.php?procode='.$pro_code.'">カートに入れる</a><br/><br/>';
}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

商品情報参照<br />
<br />
商品名<br />
<br/>
<?php print $pro_name; ?>
<br />
価格<br />
<?php print $pro_price; ?>円
<br />
<?php print $disp_gazou; ?>
<br />
内容量<br />
<?php print $pro_weight; ?>
<br />
賞味期限<br />
<?php print $pro_deadline; ?>
<br />
保存方法<br />
<?php print $pro_save; ?>
<br />
製造者<br />
<?php print $pro_product; ?>
<br />
<br />
<?php print $pro_free; ?>
<br />
<br />
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>
</article>
<?php include('../include/footer.php');?>
</body>
</html>