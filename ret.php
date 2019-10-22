<?php
if(!empty($_GET["key"])) {
	include_once("config.php");
	$key = $_GET["key"];
	$sql = "SELECT d_id,l_id,keyword FROM d_main WHERE keyword like :key OR content like :key;";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":key","%{$key}%",PDO::PARAM_STR);
	$stmt->execute();
	$count = 0;
}
?>
<?php include_once("header.php"); ?>
<main>
	<form method="get" action="ret.php" class="ret">
		<table class="ret">
			<tr>
				<th class="ret"><label for="key">検索したい言葉をいれて下さい。</label></th>
				<td class="ret"><input type="text" name="key" id="key"></td>
			</tr>
		</table>
		<p class="ret"><input type="submit" value="検索する"></p>
	</form>
	<?php if(!empty($_GET["key"])): ?>
	<div class="mainC">
		<article class="ret">
			<div class="title flex">
				<h2>検索結果</h2>
				<p class="sub">項目クリックで各ページへ</p>
			</div>
			<ul class="ret">
			<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
				<li><a href="jump.php?num=<?php echo intval($row["l_id"])."&kw=".h($row["keyword"]); ?>"><?php echo h($row["keyword"]) ?></a></li>
			<?php $count++; ?>
			<?php endwhile; ?>
			<?php if($count == 0): ?>
				<li class="none">該当する項目は見つかりませんでした。</li>
			<?php endif; ?>
			</ul>
		</article>
		<?php endif; ?>
	<div>
</main>
<?php include_once("footer.php"); ?>

