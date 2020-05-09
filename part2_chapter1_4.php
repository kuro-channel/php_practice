<?php

	// p.28　01
	print "こんにちは";
	echo "<br>\n";
	
	// p.28　02
	$a = "こんにちは\n";
	print $a; 
	echo "<br>\n";

	$b = 100;
	$c = "200円アップしたらどうなるの？";
	// A non well formed numeric value encountered
	$_c = 200;

	// $d =  $b + $c;
	$d =  $b + $_c;
	print $d;
	echo "<br>\n";

	// p.31 03
	print strrev("ABCDEFG"); // strrev：文字列を反転させる

	print pi();
	echo "<br>\n";

	print rand(0,1);
	echo "<br>\n";
	
	print rand(1,6);
	echo "<br>\n";

	// p.33 04: 文字列の扱い
	//print "<Body BGCOLOR=\"black\">";
	print "c:\\data\\test.txt";

	echo "<br>\n";

	fn_aaaaaa('','');
	echo "<br>\n";
	
	// p.36 quatation
	$_a = 2015;
	print '$_a';
	// シングルクォーテーションだと、文字列として認識される
	echo "<br>\n";

	// ダブルクォーテーションだと、中の値は展開される
	print "$_a";
	echo "<br>\n";

	// マルチバイト文字と変数を含む文字列を"で囲う場合、
	// 変数を{}で囲って記述する
	$e = "基礎";
	$f = "からの";
	$g = "PHP";
	print "{$e}{$f}知識を意識した{$g}の教科書です";
	echo "<br>\n";

	// p.38 連結演算子
	$h = "基礎";
	$h .= "からの";
	$h .= "PHP";
	print $h;
	echo "<br>\n";

	// p.39 改行をそのまま出力する
	// nl2br：「文字列」に改行が含まれる場合、改行の前に<br>を挿入する
	print nl2br("
		基礎
			からの
				PHP
	");
	echo "<br>\n";

	// p.39 定数
	define("TANKA",100); // define("定数名",値)
	$kosu = 5;
	print TANKA * $kosu;
	echo "<br>\n";

	// p.42 今日の日付
	print "今日は".date("Y")."年".date("m")."月".date("j")."日です。";
	echo "<br>\n";
	print date("今日はY年m月j日です。");

	// p.43~44
	// 変換指定子: 文字列「%s」/ 整数「%d」
	// printf: https://www.php.net/manual/ja/function.printf.php
	$form = "%sは%d年%d月%d日です。";
	printf($form,"今日",date("Y"),date("m"),date("j"));

	// jfa;lkdsajolf
	// $aaa 〇〇〇
	//　$bbb
	//　ｒｅｔｕｒｎ　ＸＸＸＸＸ
	function fn_aaaaaa($aaa, $bbb) {
		print 'function';
		return true;
	}
?>
