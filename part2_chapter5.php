<?php
	// p.47
	if(date("G") < 12) {
		print "<p>午前です</p>";
	}else {
		print "<p>午後です</p>";
	}

	// p.48,49 比較演算子
	$a = 2;
	$b = "2";

	// 同値比較
	if($a == $b){
		print "<p>そうです</p>";
	}else {
		print "<p>違います</p>";
	}

	// 同一（値も方も一緒）
	if($a === $b){
		print "<p>そうです</p>";
	}else {
		print "<p>違います</p>";
	}

	// p.50 3項演算子
	print (date("G") < 12) ? "午前です" : "午後です";

	// p.51 複合条件
	$t = date("G");
	if($t < 6 || $t >= 18){
		print "<p>夜です</p>";
	}else {
		print "<p>昼間です</p>";
	}

	// p.52 elseIf
	// if($t < 6 || $t >= 18){
	// 	print "<BODY BGCOLOR = gray>夜</BODY>";
	// }elseif($t >= 9){
	// 	print "<BODY BGCOLOR = lime>昼</BODY>";
	// }elseif($t >= 6){
	// 	print "<BODY BGCOLOR = blue>夜</BODY>";
	// }
	// echo "<br>\n";

	// p.54 入れ子、ネスト
	// if: ~ endif
	/**
	 * if(条件1):
	 * elseif(条件2):
	 * else:
	 * endif;
	 */
	if($t >= 12):
		print "午後・・・";
		if($t >= 18):
			print "夜だね";
		else:
			print "昼間だね";
		endif;
	else: 
		print "午前・・・";
		if($t >= 6):
			print "頑張って働こうね！";
		else:
			print "夜だね";
		endif;
	endif;
	echo "<br>\n";

?>
<?php
	// p.55~55
	// printやechoは省略できる
	if($t < 6 || $t >= 18){
?>
<BODY BGCOLOR = gray>夜</BODY>
	<?php } elseif($t >= 9){ ?>
<BODY BGCOLOR = lime>昼</BODY>
	<?php }elseif($t >= 6){ ?>	
<BODY BGCOLOR = blue>朝</BODY>
	<?php } echo "<br>\n";?>

<?php
	// p.66 じゃんけんシュミレーション：break応用
	for($i = 1; $i <=10; $i++){
		$n = rand(0,1);
		// じゃんけんに勝ち続けるまで「1」が表示される（最高「10個」）
		print $n."<BR>"; // rand：乱数を発生させる関数
		if($n == 0) break; // break: 処理を抜けることができる
	}

	// p.67 continue：指定した処理だけスキップ
	for($i = 1; $i <= 10; $i++){
		if($i == 5) continue;
		print $i."<BR>";
	}
?>
