<!-- TODO: あとで復習する！-->
<?php
    // セッションを開始
    session_start();
    $user = $_SESSION['user'];
    if($user == '') {
        header('Location: login_failed.html');
        exit();
    }
    
    $itemAnum = $_SESSION['itemA'];
    $itemAprice = 800 * $itemAnum;
    $itemBnum = $_SESSION['itemB'];
    $itemBprice = 900 * $itemBnum;
    $itemCnum = $_SESSION['itemC'];
    $itemCprice = 1000 * $itemCnum;
    $itemDnum = $_SESSION['itemD'];
    $itemDprice = 1000 * $itemDnum;
    $itemEnum = $_SESSION['itemE'];
    $itemEprice = 1300 * $itemEnum;
    
    $total = $itemAprice + $itemBprice + $itemCprice + $itemDprice + $itemEprice;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel=stylesheet type="text/css" href="../pentomino.css">
    <title>ピザ・ペントミノ - カート一覧</title>
</head>
<body>

<h1>ピザ・ペントミノ - カート一覧</h1>

<div align="center">
    <h2><?php echo"$user" ?>さんのカート内の商品は以下の通りです</h2>

    <form action="complete.html">
        <table class="menu">
        <tr>
            <th>品名</th>
            <th>単価</th>
            <th>注文数</th>
            <th>金額</th>
        </tr>
        
        <tr>
            <td>マルゲリータ</td>
            <td class="price">&yen;800</td>
            <td class="price"><?php echo "$itemAnum" ?>個</td>
            <td class="price">&yen;<?php echo "$itemAprice" ?></td>
        </tr>
        <tr>
            <td>バジル・トマト</td>
            <td class="price">&yen;900</td>
            <td class="price"><?php echo "$itemBnum" ?>個</td>
            <td class="price">&yen;<?php echo "$itemBprice" ?></td>
        </tr>
        <tr>
            <td>ナス・ミートソース</td>
            <td class="price">&yen;1,000</td>
            <td class="price"><?php echo "$itemCnum" ?>個</td>
            <td class="price">&yen;<?php echo "$itemCprice" ?></td>
        </tr>
        <tr>
            <td>アンチョビ・シーフード</td>
            <td class="price">&yen;1,000</td>
            <td class="price"><?php echo "$itemDnum" ?>個</td>
            <td class="price">&yen;<?php echo "$itemDprice" ?></td>
        </tr>
        <tr>
            <td>チーズ・ミルフィーユ</td>
            <td class="price">&yen;1,300</td>
            <td class="price"><?php echo "$itemEnum" ?>個</td>
            <td class="price">&yen;<?php echo "$itemEprice" ?></td>
        </tr>
        <tr>
            <th colspan="3" align="right">合計金額</th>
            <td class="price">&yen;<?php echo "$total" ?></td>
        </tr>
        </table>
        <input type="submit" value="この内容で注文する" />
    </form>
    
    <form action="item_list.php">
        <input type="submit" value="注文をやりなおす" />
    </form>
</div>

</body>
</html>
