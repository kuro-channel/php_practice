<?php
	// フォームに入力された情報を取得する
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	// ユーザー名とパスワードを確認する
	if(strcmp($pass, 'webtext') == 0){
		// ユーザー名とパスワードが正しい場合: Cookieにそのまま格納した場合
		// setcookie("user", $user);
		////setcookie("pass", $pass);

		// セッション開始
		// セッション使うときのおまじない
		session_start();

		// セッション変数にユーザー名を格納する
		$_SESSION['user'] = $user;

		header('Location: item_list.php');
	} else {
		// パスワードが誤っている場合
		header('Location: login_failed.html');
	}
?>
