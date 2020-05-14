<?php
    // セッションを開始
    session_start();
    $user = $_SESSION['user'];
    if(strcmp($user, '') == 0) {
        header('Location: login_failed.html');
        exit();
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel=stylesheet type="text/css" href="../pentomino.css">
    <title>ピザ・ペントミノ - 商品一覧</title>
</head>
<body>

<h1>ピザ・ペントミノ - 商品一覧</h1>

<div align="center">
    <h2><?php echo htmlspecialchars("$user") ?>さん、お好きなピザを選んでください</h2>

    <form action="do_item_list.php" method="post">
        <table class="menu" border="0" cellspacing="1">
        <tr>
            <th>商品</th>
            <th>価格</th>
        </tr>
        <tr>
            <td><input type="checkbox" name="itemA" value="checked" />マルゲリータ</td>
            <td class="price">&yen;800</td>
        </tr>
        <tr>
            <td><input type="checkbox" name="itemB" value="checked" />バジル・トマト</td>
            <td class="price">&yen;900</td>
        </tr>
        <tr>
            <td><input type="checkbox" name="itemC" value="checked" />ナス・ミートソース</td>
            <td class="price">&yen;1,000</td>
        </tr>
        <tr>
            <td><input type="checkbox" name="itemD" value="checked"/>アンチョビ・シーフード</td>
            <td class="price">&yen;1,000</td>
        </tr>
        <tr>
            <td><input type="checkbox" name="itemE" value="checked" />チーズ・ミルフィーユ</td>
            <td class="price">&yen;1,300</td>
        </tr>
        </table>
        <input type="submit" value="チェックした商品をカートに入れる" />
    </form>
    
    <form action="cart.php">
        <input type="submit" value="カートの内容を確認して注文へ進む" />
    </form>
    
    <form action="do_logout.php">
        <input type="submit" value="ログアウト" />
    </form>
</div>

</body>
</html>
