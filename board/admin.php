<?php

// 管理ページのログインパスワード
define('PASSWORD', 'adminPassword');

// データベースの接続情報
define('DB_HOST', 'localhost');
define('DB_NAME', 'board');
define('DB_USER', 'root');
define('DB_PASS', 'password');

// タイムゾーン指定
date_default_timezone_set('Asia/Tokyo');

// 変数の初期化
$now_date = null;
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();
$success_message = null;
$error_message = array();
$clean = array();
$db_handle = null;

// セッション開始
session_start();

// ログインボタン押下時
if (!empty($_POST["btn_submit"])) {
    if(!empty($_POST["admin_password"]) && $_POST["admin_password"] === PASSWORD){
        $_SESSION['admin_login'] = true;
    } else {
        $error_message[] = "ログインに失敗しました。";
    }
}

// DBに接続する
// データベースに接続
try {
    $db_handle = new PDO("mysql:host=localhost;dbname=board","root","1234"); 
} catch(PDOException $e) {
    $error_message[] = 'DB接続に失敗しました:'.$e -> getMessage();
}

// SQL作成
$sql = "SELECT view_name, message, post_date FROM message ORDER BY post_date DESC";
$res = $db_handle -> query($sql);

// message配列の配列（2次元配列）
// message[0][0],[0][1],[0][2]
// message[1][0],[1][1],[2][2]
// message[2][0],[2][1],[2][2]
if($res){
    while($r = $res -> fetch()){
        $message = array(
            'view_name' => $r[0],
            'message' => $r[1],
            'post_date' => $r[2],
        );
        array_unshift($message_array, $message);
    }
}

// DB接続を解除
$statement = null;
$db_handle = null;
?>
<!DOCTYPE html>
    <head>
        <title>ひと言掲示版 | 管理ページ</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0, user-scale=0">
        <link href="style.css" rel=stylesheet>
    </head>
    <body>
        <h1>ひと言掲示板 | 管理ページ</h1>
        <!-- ここにメッセージの入力フォームを設置 -->
        <!-- 書き込みエラー時メッセージ -->
        <?php if (!empty($error_message)): ?>
            <ul class="error_message">
                <?php foreach($error_message as $value): ?>
                    <li>・<?php echo $value; ?></li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
        <hr>
        <!-- セッションに値がない場合はログイン画面を表示する-->
        <?php if(!empty($_SESSION['admin_login']) && $_SESSION['admin_login'] === true): ?>
        <!-- ここにメッセージの入力フォームを設置 -->
        <section>

        <!-- ダウンロードボタン-->
        <form method="GET" action="./download.php">
            <select name="limit">
                <option value="">全て</option>
                <option value="10">10件</option>
                <option value="30">30件</option>
            </select>
            <input type="submit" name="btn_download" value="ダウンロード">
        </form>
        <?php if (!empty($message_array)): ?>
        <?php foreach ($message_array as $value): ?>
        <article>
            <div class="info">
            <h2><?php echo $value['view_name']; ?>
            <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
            </div>
            <p><?php echo $value['message']; ?></p>
        </article>
        <?php endforeach;?>
        <?php endif;?>
        <?php else: ?>
        <form method="POST">
        <div>
            <label for="admin_password">ログインパスワード</label>
            <input id="admin_password" type="password" name="admin_password" value=""> 
        </div>
        <input type="submit" name="btn_submit" value="ログイン">
        </form>
        <?php endif?>
        </section>
    </body>
</html>