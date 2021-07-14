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

require_once('./common.php');

$post=sanitize($_POST);

$pro_name=$_POST['name'];
$pro_price=$_POST['price'];
$pro_gazou=$_FILES['gazou'];
$pro_weight=$_POST['weight'];
$pro_deadline=$_POST['deadline'];
$pro_save=$_POST['save'];
$pro_product=$_POST['product'];
$pro_free=$_POST['free'];


if($pro_name=='')
{
	print '商品名が入力されていません。<br />';
}
else
{
	print '商品名:';
	print $pro_name;
	print '<br />';
}

if(preg_match('/\A[0-9]+\z/',$pro_price)==0)
{
	print '価格をきちんと入力してください。<br />';
}
else
{
	print '価格:';
	print $pro_price;
	print '円<br />';
}

if($pro_gazou['size']>0)
{
	if($pro_gazou['size']>1000000)
	{
		print '画像が大き過ぎます';
	}
	else
	{
		move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
		print '<img src="./gazou/'.$pro_gazou['name'].'">';
		print '<br />';
	}
}
if($pro_weight==''){
	print '内容量が入力されていません。<br />';
}else{
	print '内容量:';
	print $pro_weight;
	print '<br />';
}
if($pro_deadline==''){
	print '賞味期限が入力されていません。<br />';
}else{
	print '賞味期限:';
	print $pro_deadline;
	print '<br />';
}
if($pro_save==''){
	print '保存方法が入力されていません。<br />';
}else{
	print '保存方法:';
	print $pro_save;
	print '<br />';
}
if($pro_product==''){
	print '製造者が入力されていません。<br />';
}else{
	print '製造者:';
	print $pro_product;
	print '<br />';
}

if($pro_name=='' || preg_match('/\A[0-9]+\z/',$pro_price)==0 || $pro_gazou['size']>1000000 || $pro_weight=='' || $pro_deadline=='' || $pro_save=='' || $pro_product=='')
{
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}
else
{
	print '上記の商品を追加します。<br />';
	print '<form method="post" action="pro_add_done.php">';
	print '<input type="hidden" name="name" value="'.$pro_name.'">';
	print '<input type="hidden" name="price" value="'.$pro_price.'">';
	print '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'] .'">';
	print '<input type="hidden" name="weight" value="'.$pro_weight.'">';
	print '<input type="hidden" name="deadline" value="'.$pro_deadline.'">';
	print '<input type="hidden" name="save" value="'.$pro_save.'">';
	print '<input type="hidden" name="product" value="'.$pro_product.'">';
	print '<input type="hidden" name="free" value="'.$pro_free.'">';
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ">';
	print '</form>';
}

?>
</body>
</html>