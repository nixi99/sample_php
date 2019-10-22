<?php
/* ━━━━━ DB接続情報 ━━━━━ */
$host = "localhost";
$dbname = "dictionary";
$dbuser = "root";
$dbpass = "";
/* ━━━━━━━━━━━━━━━━ */

$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8;";
$pdo = new PDO($dsn,$dbuser,$dbpass);

/* ━━━━━ サニタイズ用関数 ━━━━━ */
function h($str) {
	$str = htmlspecialchars($str, ENT_QUOTES);
	return $str;
}

?>
