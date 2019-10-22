<?php
session_start();
$item = $_SESSION["lng"];
$btx = "新規作成";
$ntx = "new";
$checked = "";
$val_k = "";
$con = "";
$cd = "";
$d_id = "";
if(!empty($_GET["num"]) && !empty($_SESSION["cat"]) && $_SESSION["cat"] == $_GET["num"] && !empty($_GET["kw"])) {
$val_k = $_GET["kw"];
	$con = $_SESSION["art"][0]["content"];
	$cd = $_SESSION["art"][0]["code"];
	$d_id = array_search($_GET["kw"],$_SESSION["list"]);
	if(!empty($_GET["br"] == "edi")) {
		$btx = "編集";
		$ntx = "edi";
	}
	if(!empty($_GET["br"] == "del")) {
		$btx = "削除";
		$ntx = "del";	
	}
}
?>
<?php include_once("header.php"); ?>
			<form method="post" action="exec.php">
				<table>
					<tr>
						<th>プログラム言語</th>
						<td class="check">
						<?php foreach($item as $key=>$val): ?>
						<?php if(!empty($_GET["num"]) && !empty($_SESSION["cat"]) && $_SESSION["cat"] == $_GET["num"] && !empty($_GET["kw"])): ?>
						<?php $_GET["num"] == $key ? $checked = "checked": $checked = ""; ?>
						<?php endif; ?>
							<input type="radio" name="l_id" id="l<?php echo $key ?>" value="<?php echo $key ?>" <?php echo $checked; ?>><label for="l<?php echo $key ?>"><?php echo $val ?></label>
						<?php endforeach ?>
						</td>
					</tr>
					<tr>
						<th><label for="keyword">キーワード</label></th>
						<td><input type="text" name="keyword" id="keyword" value="<?php echo h($val_k);?>" required></td>
					</tr>
					<tr>
						<th><label for="content">内容</label></th>
						<td><textarea name="content" id="content" required><?php echo h($con); ?></textarea></td>	
					</tr>
					<tr>
						<th><label for="code">コード使用例</label></th>
						<td><textarea name="code" id="code"><?php echo h($cd); ?></textarea></td>	
					</tr>
				</table>
				<p>
					<input type="submit" value="<?php echo $btx; ?>" name="<?php echo $ntx; ?>">
					<input type="hidden" name="d_id" value="<?php echo $d_id; ?>">
				</p>
			</form>
<?php include_once("footer.php"); ?>
