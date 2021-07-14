<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<title>農園</title>
</head>
<body>
<?php include('../include/nav.php');?>
<link rel="stylesheet" href="../css/etc.css">
<header>
</header>
<article>
お客様情報を入力してください。<br /><br/>
<form method="post" action="shop_form_check2.php">
お名前<br />
<input type="text" name="onamae" style="width:200px"><br />
メールアドレス<br />
<input type="text" name="email" style="width:200px"><br />
郵便番号<br />
<input type="text" name="postal" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');"><br>
住所<br />
<input type="text" name="address" style="width:500px"><br />
電話番号<br />
<input type="text" name="tel" style="width:150px"><br />
<br/>
パスワードを入力してください。<br/>
<input type="password" name="pass" style="width: 100px;"><br/>
パスワードをもう一度入力してください。<br/>
<input type="password" name="pass2" style="width: 100px;"><br/>
性別<br/>
<input type="radio" name="danjo" value="dan"checked>男性<br/>
<input type="radio" name="danjo" value="jo">女性<br/>
年代<br/>
<select name="birth">
<option value="1920">1920年代</option>
<option value="1930">1930年代</option>
<option value="1940">1940年代</option>
<option value="1950">1950年代</option>
<option value="1960">1960年代</option>
<option value="1970">1970年代</option>
<option value="1980">1980年代</option>
<option value="1990">1990年代</option>
<option value="2000">2000年代</option>
<option value="2010">2010年代</option>
<option value="2020">2020年代</option>
</select>
<br/>
<br/>

<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ"><br />
</form>
</article>
<?php include('../include/footer.php');?>
</body>
</html>