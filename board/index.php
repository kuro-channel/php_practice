<?php

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

if (!empty($_POST["btn_submit"])) {

    // 表示名の入力チェック
    if (empty($_POST['view_name'])) {
        $error_message[] = '表示名を入力してください。';
    } else {
        // スクリプトインジェクション対策
        $clean['view_name'] = htmlspecialchars($_POST['view_name'], ENT_QUOTES);
        // 表示名：改行を削除 \n \r\n \r
        $clean['view_name'] = preg_replace('/\\r\\n | \\n | \\r/','',$clean['view_name']);

        // セッションに表示名を保存
        $_SESSION['view_name'] = $clean['view_name'];
    }

    // メッセージの入力チェック
    if (empty($_POST['message'])) {
        $error_message[] = 'ひと言メッセージを入力してください。';
    } else {
        // スクリプトインジェクション対策
        $clean['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);
        // ひと言コメント：改行を<BR>に変換 \n \r\n \r
        $clean['message'] = preg_replace('/\\r\\n | \\n | \\r/','<BR>',$clean['message']);
    }

    // エラーメッセージに値が格納されていない場合は書き込み可能
    if (empty($error_message)) {

        // データベースに接続
        try {
            $db_handle = new PDO("mysql:host=localhost;dbname=board","root","1234");
            
        }catch(PDOException $e) {
            $error_message[] = 'DB接続に失敗しました:'.$e -> getMessage();
        }

        // 書き込み日時を取得
        $now_date = date("Y-m-d H:i:s");

        // SQL作成
        $sql = "INSERT INTO message (view_name, message, post_date) VALUES (:name , :message, :date)";

        // SQL実行準備
        $statement = $db_handle -> prepare($sql);

        // 値を設定
        $statement -> bindParam(":name", $clean['view_name']);
        $statement -> bindParam(":message", $clean['message']);
        $statement -> bindParam(":date", $now_date);
        $result = $statement -> execute();
        $success_message = 'メッセージを書き込みました。';

        // DB接続を解除
        $statement = null;
        $db_handle = null;
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