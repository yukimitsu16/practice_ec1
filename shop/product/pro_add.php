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
<title></title>
</head>
<body>

商品追加<br/>
<br/>
<form method="post"action="pro_add_check.php" enctype="multipart/form-data">
商品名を入力してください。<br/>
<input type="text" name="name"style="width:200px"><br/>
価格を入力してください。<br/>
<input type="text" name="price"style="width:50px"><br/>
画像を選んでください。<br/>
<input type="file" name="gazou" style="width:400px"><br/>
内容量を入力してください。<br/>
<input type="text" name="weight"style="width:200px">g<br/>
賞味期限入力してください。(西暦)<br/>
<input type="text" name="deadline"style="width:200px"><br/>
保存方法を入力してください。<br/>
<input type="text" name="save"style="width:400px"><br/>
製造者を入力してください。<br/>
<input type="text" name="product"style="width:200px"><br/>
フリーで入力してください。<br/>
<textarea name="free" rows="4" cols="40"></textarea><br/>
<br/>
<input type="button" onclick="history.back()"value="戻る">
<input type="submit" value="OK">
</form>
</body>
</html>