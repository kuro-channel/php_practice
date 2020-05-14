<?php
	// キャッシュを無効にする
	// https://qiita.com/hkusu/items/d40aa8a70bacd2015dfa
//	header('Cache-Control: no-cache');
//
//	// Cookieの内容を取得する
//	$user = $_COOKIE['user'];
//	$pass = $_COOKIE['pass'];
//
//	// ユーザー名とパスワードを確認する
//	if(strcmp($user, "satou") != 0 && strcmp($pass, "webtext") != 0) {
//        // ユーザー名とパスワードが間違っている場合
//		// Cookieの内容を取り消してlogin_failed.htmlへリダイレクト
//        setcookie("user", "", time() - 3600);
//        setcookie("pass", "", time() - 3600);
//        header('Location: login_failed.html');
//        exit();
//    }

	// セッション開始
	// do_login.phpでSESSIONに格納した値：ユーザーIDを取り出す
	session_start();
	$user = $_SESSION['user'];
	if(strcmp($user, '') == 0) {
        header('Location: login_failed.html');
        exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ピザ・ペントミノ - 商品一覧</title>
	<link href="./style.css" rel="stylesheet">
</head>
<body>
	<div class="content">
	<h1>ピザ・ペントミノ - 商品一覧</h1>
	<h2><?php echo htmlspecialchars($user)?>さん、お好きなピザを選んでください</h2>
	<form action="do_item_list.php" method="post">
		<table class="list" align="center">
			<tr>
				<th>商品</th>
				<th>価格</th>
			</tr>
			<tr>
				<td><input type="checkbox" name="itemA" value="checked">マルゲリータ</td>
				<td class="price">¥1,000</td>
			</tr>
			<tr>
				<td><input type="checkbox" name="itemB" value="checked">バジル・トマト</td>
				<td class="price">¥900</td>
			</tr>
			<tr>
				<td><input type="checkbox" name="itemC" value="checked">ナス・ミートソース</td>
				<td class="price">¥1,000</td>
			</tr>
			<tr>
				<td><input type="checkbox" name="itemD" value="checked">アンチョビ・シーフード</td>
				<td class="price">¥1,000</td>
			</tr>
			<tr>
				<td><input type="checkbox" name="itemE" value="checked">チーズ・ミルフィーユ</td>
				<td class="price">¥1,300</td>
			</tr>
		</table>
		<input type="submit" value="チェックした商品をカートに入れる">
	</form>
		<form action="cart.php">
			<input type="submit" value="カートの内容を確認して注文へ進む">
		</form>
		<form action="do_logout.php">
		<input type="submit" value="ログアウト">
		</form>
	</div>
</body>
</html>