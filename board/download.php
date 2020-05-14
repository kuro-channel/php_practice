<?php

// データベースの接続情報
define('DB_HOST', 'localhost');
define('DB_NAME', 'board');
define('DB_USER', 'root');
define('DB_PASS', 'password');

// 変数の初期化
$db_handle = null;
$csv_data = null;
$data = null;
$sql = null;
$res = null;
$message_array = array();
$limit = null;

// セッション開始
session_start();

// 取得件数
if(!empty($_GET['limit'])){
    // 10件の場合
    if($_GET['limit'] === "10"){
        $limit = 10;
    } elseif($_GET['limit'] === "30"){
        $limit = 30;
    }
}

// ログインボタン押下時
if(!empty($_SESSION["admin_login"]) && $_SESSION["admin_login"] === true){
    // ファイル出力の設定
    header("Content-Type: application/octet-stream"); // Content-Type
    header("Content-Disposition: attachment;filename=メッセージデータ.csv"); // ファイル名
    header("Content-Transfer-Encoding: binary"); // エンコーディング

    // データベースに接続し、データを取得
    try{
        $db_handle = new PDO("mysql:host=localhost;dbname=board", "root", "1234");
    }catch(PDOException $e){
        $error_message[] = "DB接続に失敗しました :".$e -> getMessage();
    }

    // SQL作成
    if(!empty($limit)){
        $sql = "SELECT * FROM message ORDER BY post_date DESC LIMIT $limit";
    } else {
        $sql = "SELECT * FROM message ORDER BY post_date DESC";
    }
    
    $res = $db_handle -> query($sql);

    // message配列の配列（2次元配列）
    // message[0][0],[0][1],[0][2]
    // message[1][0],[1][1],[2][2]
    // message[2][0],[2][1],[2][2]
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
    }

    // DB接続を解除
    $statement = null;
    $db_handle = null;


    // CSVデータを作成
    if(!empty($message_array)) {

        // 1行目のラベル作成
        $csv_data .='"ID,"表示名","メッセージ","投稿日時"'."\n";

        // データを1行ずつCSVファイルに書き込む
        foreach($message_array as $value){
            // データを1行ずつCSVファイルに書き込む
            $csv_data .= '"'.$value['id'].'","'.$value['view_name'].'","'.$value['message'].'","'.$value['post_date'].'","'."\"\n";
        }
        // CSVファイル出力
        echo $csv_data;
    } 
} else {
        echo $res;
        // ログインページへのリダイレクト
        header("Location: ./admin.php");
}
?>