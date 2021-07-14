<?php
	session_start();
	session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>農園</title>
</head>
<body>

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

if($_SESSION['cart']==''){
	'<a href="shop_list.php">商品一覧へ</a>';
}else{
print $onamae.'様<br />';
print 'ご注文ありがとうござました。<br />';
print $email.'にメールを送りましたのでご確認ください。<br />';
print '商品は以下の住所に発送させていただきます。<br />';
print $postal.'<br />';
print $address.'<br />';
print $tel.'<br />';

$honbun='';
$honbun.=$onamae."様\n\nこのたびはご注文ありがとうございました。\n";
$honbun.="\n";
$honbun.="ご注文商品\n";
$honbun.="--------------------\n";

$cart=$_SESSION['cart'];
$kazu=$_SESSION['kazu'];
$max=count($cart);

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

for($i=0;$i<$max;$i++)
{
	$sql='SELECT name,price FROM mst_product WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data[0]=$cart[$i];
	$stmt->execute($data);

	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	
	$name=$rec['name'];
	$price=$rec['price'];
	$kakaku[]=$price;
	$suryo=$kazu[$i];
	$shokei=$price*$suryo;

	$honbun.=$name.' ';
	$honbun.=$price.'円 x ';
	$honbun.=$suryo.'個 = ';
	$honbun.=$shokei."円\n";
}
$sql='LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$lastmembercode=0;
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

	$sql='SELECT LAST_INSERT_ID()';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	$lastmembercode=$rec['LAST_INSERT_ID()'];

$sql='INSERT INTO dat_sales (code_member,name,email,postal,address,tel) VALUES (?,?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data=array();
$data[]=$lastmembercode;
$data[]=$onamae;
$data[]=$email;
$data[]=$postal;
$data[]=$address;
$data[]=$tel;
$stmt->execute($data);

$sql='SELECT LAST_INSERT_ID()';
$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$lastcode=$rec['LAST_INSERT_ID()'];

for($i=0;$i<$max;$i++)
{
	$sql='INSERT INTO dat_sales_product (code_sales,code_product,price,quantity) VALUES (?,?,?,?)';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=$lastcode;
	$data[]=$cart[$i];
	$data[]=$kakaku[$i];
	$data[]=$kazu[$i];
	$stmt->execute($data);
}

$sql='UNLOCK TABLES';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

$honbun.="送料は無料です。\n";
$honbun.="--------------------\n";
$honbun.="\n";
$honbun.="代金は以下の口座にお振込ください。\n";
$honbun.="銀行 やさい支店 普通口座 １２３４５６７\n";
$honbun.="入金確認が取れ次第、梱包、発送させていただきます。\n";
$honbun.="\n";
$honbun.="□□□□□□□□□□□□□□\n";
$honbun.="　～むかしの野菜の邑～\n";
$honbun.="\n";
$honbun.="○○県六丸郡六丸村123-4\n";
$honbun.="電話 090-6060-xxxx\n";
$honbun.="メール info@rokumarunouen.co.jp\n";
$honbun.="□□□□□□□□□□□□□□\n";

//print '<br />';
//print nl2br($honbun);

}
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

</body>
</html>