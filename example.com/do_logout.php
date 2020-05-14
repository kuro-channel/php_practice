<?php
    // Cookieの内容を取り消してlogin.htmlへリダイレクト
	setcookie("user", "", time() - 3600);
	setcookie("pass", "", time() - 3600);

	// セッションを破棄してログイン画面に戻る
	session_start();
	session_destroy();
	header('Location: login.html');
?>
