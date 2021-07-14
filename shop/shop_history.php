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
<a href="shop_list.php">商品一覧へ</a><br/>
<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	print 'ログインされていません。<br />';
	print '<a href="shop_list.php">商品一覧へ</a>';
}else{
	$member_code=$_SESSION['member_code'];
}

?>
</header>
<article>

<?php
try{
    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//３つ結合して表示のパターン
    $sql='SELECT COUNT(dat_sales_product.code)
    FROM 
	dat_sales, dat_sales_product, dat_member 
    WHERE 
	dat_sales.code_member=dat_member.code 
	AND dat_sales.code=dat_sales_product.code_sales 
	AND code_member=?;';
    $stmt=$dbh->prepare($sql);
    $data1[]=$member_code;
    $stmt->execute($data1);
    $count1=$stmt-> fetch(PDO::FETCH_COLUMN);
    echo '件数は'.$count1.'件です<br/><br/>';

//検索データ一覧で表示 
    $sql='SELECT 
    dat_sales.name,
    dat_sales.date,
    dat_sales_product.code_product,
    dat_sales_product.price,
    dat_sales_product.quantity,
    mst1_product.name,
    mst1_product.gazou 
    FROM 
    dat_sales 
    INNER JOIN 
    dat_sales_product 
    ON 
    dat_sales.code=dat_sales_product.code_sales 
    INNER JOIN 
    mst1_product 
    ON 
    dat_sales_product.code_product=mst1_product.code  
    WHERE 
    code_member=? 
    ORDER BY date DESC;';
    $stmt=$dbh->prepare($sql);
    
    $data[]=$member_code;
    $stmt->execute($data);
    // $rec=$stmt->fetch(PDO::FETCH_ASSOC);
   
    
   foreach ($stmt as $row) {
    $toshi=$row['date'];
    $day=date('Y年m月d日', strtotime($toshi));

    $pro_gazou_name=$row['gazou'];
    $disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'"width=200px>';

    // データベースのフィールド名で出力
  echo $day.' '.$disp_gazou.''.$row['name'].' '.$row['quantity'].'個  '.$row['price'].'円';
    // echo $row['name'].'：'.$row['code_product'].'：'.$row['price'].'円' .$row['quantity'].'個'.;
    echo '<br>';
  } 
    $dbh=null;
}
catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>
<a href="shop_list.php">商品一覧へ</a><br/>
</article>
<?php include('../include/footer.php');?>
</body>
</html>