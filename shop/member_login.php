<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
    <?php include('../include/nav.php');?>
    <link rel="stylesheet" href="../css/etc.css">
    <header>
    </header>
    <article>
会員ログイン<br/>
<br/>
<form method="post"action="member_login_check.php">
メールアドレス<br/>
<input type="text" name="email"><br/>
パスワード<br/>
<input type="password" name="pass"><br/>
<br/>
<input type="submit" value="ログイン">
<a href="shop_list.php">商品一覧へ戻る</a>
</form>
</article>
<?php include('../include/footer.php');?>
</body>
</html>