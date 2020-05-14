<?php
    // セッションを破棄してログイン画面に戻る
    session_start();
    session_destroy();
    header('Location: login.html');
?>
