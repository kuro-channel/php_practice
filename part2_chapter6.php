<?php
	// p.69 標準体重を求める
	// 「身長（m）の2乗×22が標準体重(kg)」
	$s = 168; // cm
	$sc = $s /100; // mに直す
	$sb = round($sc * $sc * 22, 1);
	print "標準体重は".$sb."kgです";
	echo "<br>\n";
	
	// 関数化
	function hyozyun($s){
		$sc = $s /100; // mに直す
		$sb = round($sc * $sc * 22, 1);
		print "標準体重は".$sb."kgです";		
	}
	hyozyun(168);
	echo "<br>\n";

	// p.71 160~180cmの標準体重リスト
	for($a = 160; $a <= 180; $a++){
		print "身長".$a."cmなら";
		print hyozyun($a);
		echo "<br>\n";
	}

	// p.73 戻り値
	// 140~160cmの標準体重リスト
	for($a = 140; $a <= 160; $a++){
		print "身長".$a."cmなら";
		print hyozyun2($a);
		echo "<br>\n";
	}
	function hyozyun2($s){
		$sc = $s /100; // mに直す
		$sb = round($sc * $sc * 22, 1);
		return "標準体重は".$sb."kgです";	
	}

	
?>