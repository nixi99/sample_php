<?php
session_start();
if(empty($_POST["l_id"]) || empty($_POST["keyword"]) || empty($_POST["content"])) {
	header("Location:insert.php");
	exit();
}
include_once("config.php");
// INSERT処理
if(!empty($_POST["new"])){
	$sql = "INSERT INTO d_main(l_id, keyword, content,code) VALUES(:l_id,:keyword,:content,:code);";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":l_id",$_POST["l_id"],PDO::PARAM_INT);
	$stmt->bindValue(":keyword",$_POST["keyword"],PDO::PARAM_STR);
	$stmt->bindValue(":content",$_POST["content"],PDO::PARAM_STR);
	$stmt->bindValue(":code",$_POST["code"],PDO::PARAM_STR);
	$stmt->execute();
	header("Location:index.php");
	exit();
}
// UPDATE処理
if(!empty($_POST["edi"])) {
	$sql2 = "UPDATE d_main SET l_id=:l_id,keyword=:keyword,content=:content,code=:code WHERE d_id=:d_id;";
	$stmt2 = $pdo->prepare($sql2);
	$stmt2->bindValue(":l_id",$_POST["l_id"],PDO::PARAM_INT);
	$stmt2->bindValue(":keyword",$_POST["keyword"],PDO::PARAM_STR);
	$stmt2->bindValue(":content",$_POST["content"],PDO::PARAM_STR);
	$stmt2->bindValue(":code",$_POST["code"],PDO::PARAM_STR);
	$stmt2->bindValue(":d_id",$_POST["d_id"],PDO::PARAM_INT);
	$stmt2->execute();
	header("Location:jump.php?num={$_POST["l_id"]}&kw={$_POST["keyword"]}");
	exit();
}
// DELETE処理
if(!empty($_POST["del"])) {
	$sql3 = "DELETE FROM d_main WHERE d_id=:d_id;";
	$stmt3 = $pdo->prepare($sql3);
	$stmt3->bindValue(":d_id",$_POST["d_id"],PDO::PARAM_INT);
	$stmt3->execute();
	header("Location:index.php?num={$_POST["l_id"]}");
	exit();
}
?>
