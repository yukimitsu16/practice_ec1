<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="../css/list.css">
<title>農園</title>
</head>
<body>

<?php include('../include/nav.php');?>

<div class='header'>
<img src="../imag/旬の野菜セット.jpg" alt="旬の野菜">
<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{	
	print 'ようこそゲストさん　';
	print '<a href="member_login.php">会員ログイン </a>';
	print '<a href="shop_form2.php">新規登録 </a>';
}
else
{
	print 'ようこそ';
	print $_SESSION['member_name'];
	print ' 様　';
	print '<a href="member_logout.php">ログアウト</a><br />';
	print '<a href="shop_history.php">購入履歴</a><br/>';
	print '<a href="../order/order_download.php">注文ダウンロード</a>';
}
?>
<p><a href="shop_cartlook.php"><img src="../imag/カート.jpg"　alt="カート"></a><br/></p>
</div>

<article>
	<p>商品一覧<br /><br /></p>
<div class=hobun>
<?php

try
{

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name,price,gazou FROM mst1_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
	$pro_gazou_name=$rec['gazou'];
	print '<a href="shop_product.php?procode='.$rec['code'].'">';
	if($pro_gazou_name==''){
		$disp_gazou='';
		}else{
		print $disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'"width=200px>';
		}
	print'<div class=price>';
	print '<p>'.$rec['name'].'</p>';
	print '<p>'.$rec['price'].'円'.'</p>';
	print '</div>';
	print '</a>';
	print '<br />';
}
  print'<br/>';
  
}
catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>
</div>
<a href="../staff_login/staff_login.html">生産者の方</a><br/>
</article>
<?php include('../include/footer.php');?>

</body>
</html>