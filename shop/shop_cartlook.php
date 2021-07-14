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
	print 'ようこそゲスト様　';
	print '<a href="member_login.php">会員ログイン</a><br />';
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

if(isset($_SESSION['cart'])==true){
$cart=$_SESSION['cart'];
$kazu=$_SESSION['kazu'];
$max=count($cart);
}
else{
	$max=0;
}
if($max==0)
{
	print 'カートに商品が入っていません。<br/>';
	print '<br/>';
	print '<a href="shop_list.php">商品一覧へ戻る</a>';
	print'</article>';
 	include('../include/footer.php');
	exit();
}

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

foreach($cart as $key=>$val)
{
	$sql='SELECT code,name,price,gazou FROM mst1_product WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data[0]=$val;
	$stmt->execute($data);

	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	$pro_name[]=$rec['name'];
	$pro_price[]=$rec['price'];
	if($rec['gazou']=='')
	{
		$pro_gazou[]='';
	}
	else
	{
		$pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'">';
	}
}
$dbh=null;
}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

カートの中身<br />
<br />
<form method="post" action="kazu_change.php">
<?php for($i=0;$i<$max;$i++)
	{
?>
	<?php echo $pro_name[$i]; ?>
	<?php echo $pro_gazou[$i]; ?>
	<?php echo $pro_price[$i]; ?>円
	<input type="text" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i]; ?>">
	小計---<?php print $pro_price[$i]*$kazu[$i];?>円
	<br/>
	<input type="submit" name="sakujo<?php print $i;?>"value="削除">
	<br />
	<input type="submit" value="数量変更"><br />
	<br />
<?php
	}
?>
<input type="hidden" name="max" value="<?php print $max; ?>">

</form>
<br/>
<a href="shop_list.php">商品一覧へ</a><br/>
<?php
	if(isset($_SESSION["member_login"])==true){
		print'<a href="shop_kantan_check.php">レジへ進む</a><br/>';
	}else{
		print'<a href="shop_form.html">レジへ進む</a><br/>';
	}
?>
</article>
<?php include('../include/footer.php');?>
</body>
</html>