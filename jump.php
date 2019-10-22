<?php
session_start();
if(empty($_GET["num"]) || empty($_GET["kw"])) {
	header("Location:index.php");
	exit();
}
// 個別ページに飛ぶための処理
include_once("config.php");
$sql = "SELECT d_id,keyword FROM d_main WHERE l_id = :num;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":num", $_GET["num"], PDO::PARAM_INT);
$stmt->execute();
$list = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$list += [$row["d_id"]=>$row["keyword"]];
}
$_SESSION["list"] = $list;
$_SESSION["cat"] = $_GET["num"];
header("Location:index.php?num={$_GET["num"]}&kw={$_GET["kw"]}");
exit();
?>
