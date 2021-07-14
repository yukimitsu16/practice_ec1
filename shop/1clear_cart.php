<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	exit();
}
?>
<?php

try
{

require_once('./common.php');

$post=sanitize($_POST);

if(isset($_SESSION['member_login'])==true)
    {
        $_SESSION['cart']=null;
        $_SESSION['kazu']=null;
    }

    header('Location:shop_list.php');
    exit();
}
catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>農園</title>
</head>
<body>

カートを空にしました。<br />

</body>
</html>
