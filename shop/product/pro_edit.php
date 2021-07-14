
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
$pro_gazou_name_old=$rec['gazou'];
$pro_weight=$rec['weight'];
$pro_deadline=$rec['deadline'];
$pro_save=$rec['save'];
$pro_product=$rec['product'];
$pro_free=$rec['free'];

$dbh=null;

if($pro_gazou_name_old=='')
{
	$disp_gazou='';
}
else
{
	$disp_gazou='<img src="./gazou/'.$pro_gazou_name_old.'">';
}

}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

商品修正<br />
<br />
商品コード<br />
<?php print $pro_code; ?>
<br />
<br />
<form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
<input type="hidden" name="code" value="<?php print $pro_code; ?>">
<input type="hidden" name="gazou_name_old" value="<?php print $pro_gazou_name_old; ?>">
商品名<br />
<input type="text" name="name" style="width:200px" value="<?php print $pro_name; ?>"><br />
価格<br />
<input type="text" name="price" style="width:50px" value="<?php print $pro_price; ?>">円<br />
<br />
<?php print $disp_gazou; ?>
<br />
画像を選んでください。<br />
<input type="file" name="gazou" style="width:400px" value="<?php print $pro_name; ?>"><br />
<br />
内容量を入力してください。<br/>
<input type="text" name="weight"style="width:200px" value="<?php print $pro_weight; ?>">g<br/>
<br />
賞味期限入力してください。(西暦)<br/>
<input type="text" name="deadline"style="width:200px" value="<?php print $pro_weight; ?>"><br/>
<br />
保存方法を入力してください。<br/>
<input type="text" name="save"style="width:400px" value="<?php print $pro_save; ?>"><br/>
<br />
製造者を入力してください。<br/>
<input type="text" name="product"style="width:200px" value="<?php print $pro_product; ?>"><br/>
<br />
フリーで入力してください。<br/>
<textarea name="free" rows="4" cols="40" value="<?php print $pro_free; ?>"></textarea><br/>
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ">
</form>

</body>
</html>