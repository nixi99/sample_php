<?php
session_start();
// タイトル入力
$title = "編集メニュー";
$like = "お気に入り登録";

if(!empty($_GET["num"])) {
	include_once("config.php");
	$sql = "SELECT * FROM lang WHERE l_id = :num;";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":num", $_GET["num"], PDO::PARAM_INT);
	$stmt->execute();
	$tg = $stmt->fetch(PDO::FETCH_ASSOC);
	$title = $tg["l_name"];
// キーワード出力
	$sql2 = "SELECT d_id,keyword FROM d_main WHERE l_id = :num;";
	$stmt2 = $pdo->prepare($sql2);
	$stmt2->bindValue(":num", $_GET["num"], PDO::PARAM_INT);
	$stmt2->execute();
	if(empty($_GET["kw"]) || empty($_SESSION["list"]) || empty($_SESSION["cat"]) || $_SESSION["cat"] !== $_GET["num"]) {
		$list = [];
		$_SESSION["list"] = [];
		$_SESSION["cat"] = [];
	}
// 中身の取得
	if(!empty($_GET["kw"])) {
		$sql3 = "SELECT content,code,bkm FROM d_main WHERE keyword = :kw;";
		$stmt3 = $pdo->prepare($sql3);
		$stmt3->bindValue(":kw", $_GET["kw"], PDO::PARAM_STR);
		$stmt3->execute();
		$art = $stmt3->fetchAll(PDO::FETCH_ASSOC);
		$_SESSION["art"] = $art;
		$d_id = array_search($_GET["kw"],$_SESSION["list"]);
		$like = $art[0]["bkm"] == 0 ? "お気に入りに登録" : "お気に入りを解除";

	}
// お気に入り登録＆解除
	if(isset($_GET["bkm"])) {
	$sql4 = "UPDATE d_main SET bkm=:bkm WHERE d_id=:d_id;";
	$stmt4 = $pdo->prepare($sql4);
	$stmt4->bindValue(":bkm",$_GET["bkm"],PDO::PARAM_INT);
	$stmt4->bindValue(":d_id",$_GET["d_id"],PDO::PARAM_INT);
	$stmt4->execute();
	header("Location:index.php?num={$_GET["num"]}&kw={$_GET[kw]}");
	exit();
	}

}
?>
<?php include_once("header.php"); ?>
			<main>
				<h2><?php echo $title; ?></h2>
				<div class="mainC">
					<article>
					<?php if(empty($_GET["num"])): ?>
						<div class="cT">
							<ul>
								<li><a href="insert.php">新規作成</a></li>
								<li><a href="auth.php">言語の追加</a></li>
								<li><a href="auth.php?br=del">言語の削除</a></li>
							</ul>
						</div><!-- END .cT -->
					<?php elseif(!empty($_GET["num"]) && !empty($_GET["kw"]) && $_SESSION["cat"] == $_GET["num"]): ?>
						<ul class="mx_hi">
						<?php foreach($_SESSION["list"] as $key=>$val): ?>
						<li class="btn"><a class="flo" href="index.php?num=<?php echo intval($_GET["num"])."&kw=".h($val); ?>"><?php echo h($val); ?></a></li>
						<?php endforeach; ?>
						</ul>
						<div class="aCont">
							<div class="aText">
								<h3><?php echo h($_GET["kw"]); ?></h3>
								<p><?php echo nl2br(h($art[0]["content"])); ?></p>
							</div><!-- aText -->
							<?php if(!empty($art[0]["code"])): ?>
							<div class="code">
								<h4>【コード例】</h4>
								<pre><code><?php echo nl2br(h($art[0]["code"])); ?></code></pre>
							</div><!-- code -->
							<?php endif; ?>
						</div><!-- END .aCont -->
						<p class="btn">
							<a href="insert.php?num=<?php echo intval($_GET["num"])."&kw=".h($_GET["kw"])."&br=edi"; ?>">編集</a>
							<a href="insert.php?num=<?php echo intval($_GET["num"])."&kw=".h($_GET["kw"])."&br=del"; ?>">削除</a>
							<a href="index.php?num=<?php echo intval($_GET["num"])."&kw=".h($_GET["kw"])."&d_id=".intval($d_id)."&bkm=".intval(!$art[0]["bkm"]); ?>"><?php echo $like ;?></a>
						</p>
					<?php else: ?>
						<div class="cT">
							<ul>
							<?php while($row = $stmt2->fetch(PDO::FETCH_ASSOC)): ?>
								<li><a class="cT" href="index.php?num=<?php echo intval($_GET["num"])."&kw=".h($row["keyword"]); ?>"><?php echo h($row["keyword"]); ?></a></li>
							<?php $list += [$row["d_id"]=>$row["keyword"]]; ?>
							<?php endwhile; ?>
							<?php $_SESSION["list"] = $list; ?>
							<?php $_SESSION["cat"] = $_GET["num"]; ?>
							</ul>
						</div><!-- END .cT -->
					<?php endif; ?>
					</article>
				</div><!-- End div.mainC -->
			</main>
<?php include_once("footer.php"); ?>

