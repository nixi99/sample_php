<?php
$btx = "新規作成";
$ntx = "new";
$lab = "l_name";
// INSERT処理
if(!empty($_POST["l_name"]) && empty($_POST["del"])) {
	include_once("config.php");
	$sql = "INSERT INTO lang(l_name) VALUES(:l_name);";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":l_name",$_POST["l_name"],PDO::PARAM_STR);
	$stmt->execute();
	header("Location:index.php");
	exit();
}
// 削除のページ
if(!empty($_GET["br"])) {
	$btx = "削除";
	$ntx = "del";
}
// DELETE処理
if(!empty($_POST["del"])) {
	include_once("config.php");
	$sql2 = "DELETE FROM lang WHERE l_id=:l_id;";
	$stmt2 = $pdo->prepare($sql2);
	$stmt2->bindValue(":l_id",$_POST["l_id"],PDO::PARAM_INT);
	$stmt2->execute();
	header("Location:index.php");
	exit();
}
?>
<?php include_once("header.php"); ?>
			<form method="post" action="auth.php">
				<table>
					<tr>
						<th><label for="l_name">言語名</label></th>
						<td>
						<?php if(!empty($_GET["br"])): ?>
							<select id="l_id" name="l_id">
								<option value="">削除する言語の選択</option>
								<?php foreach($les as $key=>$val): ?>
								<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
								<?php endforeach; ?>
							</select>
						<?php else: ?>
							<input type="text" name="l_name" id="l_name">
						<?php endif; ?>
						</td>
					</tr>
				</table>
				<p>
					<input type="submit" value="<?php echo $btx; ?>" name="<?php echo $ntx; ?>">
				</p>
			</form>
<?php include_once("footer.php"); ?>
