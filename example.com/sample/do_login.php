<?php
    // フォームに入力された内容を取得する
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    
    // パスワードを確認する
    if(strcmp($pass, 'webtext') == 0) {
        // セッション開始
        session_start();
        
        // セッション変数にユーザ名を格納する
        $_SESSION['user'] = $user;
        
        header('Location: item_list.php');
    } else {
        // パスワードが誤っている場合
        header('Location: login_failed.html');
    }
?>
