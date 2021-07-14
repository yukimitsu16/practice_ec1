<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
    print'ログインされていません';
    print'<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
}
else{
    print $_SESSION['staff_name'];
    print 'さんログイン中<br/>';
    print '<br/>';
}
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

$pro_name=$_POST['name'];
$pro_price=$_POST['price'];
$pro_gazou_name=$_POST['gazou_name'];
$pro_weight=$_POST['weight'];
$pro_deadline=$_POST['deadline'];
$pro_save=$_POST['save'];
$pro_product=$_POST['product'];
$pro_free=$_POST['free'];

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='INSERT INTO mst1_product(name,price,gazou,weight,deadline,save,product,free) VALUES (?,?,?,?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data[]=$pro_name;
$data[]=$pro_price;
$data[]=$pro_gazou_name;
$data[]=$pro_weight;
$data[]=$pro_deadline;
$data[]=$pro_save;
$data[]=$pro_product;
$data[]=$pro_free;
$stmt->execute($data);

$dbh=null;

print $pro_name;
print 'を追加しました。<br />';

}
catch(Exception$e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<a href="pro_list.php">戻る</a>

</body>
</html>