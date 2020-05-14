<?php

// データベースの接続情報
define('DB_HOST', 'localhost');
define('DB_NAME', 'board');
define('DB_USER', 'root');
define('DB_PASS', 'password');

// タイムゾーン指定
date_default_timezone_set('Asia/Tokyo');

// 変数の初期化
$db_handle = null;
$error_message = array();

// セッション開始
session_start();

// ログインセッションがない場合は管理ページへリダイレクト
if(empty($_SESSION['admin_login'] || $_SESSION['admin_login'] !== true)){
    header("Location: ./admin.php");
}

// 投稿IDチェック
if(!empty($_GET['message_id'])){
    
    // メッセージIDをサニタイズ
    $message_id = (int)htmlspecialchars($_GET['message_id'], ENT_QUOTES);

    // データベースに接続し、データを取得
    try {
        $db_handle = new PDO("mysql:host=localhost;dbname=board", "root", "1234");
    }catch(PDOException $e) {
        $error_message[] = "DB接続に失敗しました ：".$e -> getMessage();
    }

    $sql = "SELECT * FROM message WHERE id = $message_id";
    $res = $db_handle -> query($sql);

    if($res){
        while($r = $res -> fetch()){
            $message = array(
                'id' => $r[0],
                'view_name' => $r[1],
                'message' => $r[2],
                'post_date' => $r[3],
            );
            array_unshift($message_array, $message);
        }
    } else {
        // データが読み込めなかったら管理ページに戻る
        header("Location: ./admin.php");
    }

    // DB接続を解除
    $statement = null;
    $db_handle = null;
}

?>
<!DOCTYPE html>
    <head>
        <title>ひと言掲示版</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0, user-scale=0">
        <link href="style.css" rel=stylesheet>
    </head>
    <body>
        <h1>ひと言掲示板</h1>
        <!-- ここにメッセージの入力フォームを設置 -->
        <!-- 書き込み時メッセージ -->
        <?php if (!empty($success_message)): ?>
            <p class="success_message"><?php echo $success_message; ?></p>
        <?php endif;?>
        <!-- 書き込みエラー時メッセージ -->
        <?php if (!empty($error_message)): ?>
            <ul class="error_message">
                <?php foreach($error_message as $value): ?>
                    <li>・<?php echo $value; ?></li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
        <hr>
        <form method="POST">
            <div>
                <label for="view_name">表示名</label>
                <input id="view_name" type="text" name="view_name" value=<?php if(!empty($_SESSION['view_name'])){
                    echo $_SESSION['view_name'];} ?>>
            </div>
            <div>
                <label for="message">ひと言メッセージ</label>
                <textarea id="message" name="message"></textarea>
            </div>
            <input type="submit" name="btn_submit" value="書き込む">
        </form>
        <!-- ここにメッセージの入力フォームを設置 -->
        <section>
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
        </section>
    </body>
</html>