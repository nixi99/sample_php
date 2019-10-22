<?php 
include_once("config.php");
session_start();
$sql = "SELECT d_id,l_id,keyword FROM d_main WHERE bkm=1 ORDER BY l_id;";
$bkm = $pdo->query($sql);
$i = 0;
${"list".$i} = [];
$item = $_SESSION["lng"];
foreach($item as $key=>$val) {
	$i = $key;
	${"list".$i} = [];
}
while($row = $bkm->fetch(PDO::FETCH_ASSOC)){
	$i = $row["l_id"];
	${"list".$i} += [$row["d_id"]=>$row["keyword"]];
}
?>
<?php include_once("header.php"); ?>
		<main class="la">
				<h2>よく見る単語</h2>
				<div class="mainC">
				<article class="la">
					<?php foreach($item as $key=>$val): ?>
					<div class="bkm_d">
						<h3><?php echo $val; ?></h3>
						<ul>
						<?php $i = $key;?>
						<?php foreach(${"list".$i} as $val2): ?>
							<li><a href="jump.php?num=<?php echo intval($i)."&kw=".h($val2); ?>"><?php echo h($val2); ?></a></li>		
						<?php endforeach; ?>
						</ul>
					</div>
					<?php endforeach; ?>
				</article>
				</div><!-- End div.mainC -->
			</main>
<?php include_once("footer.php"); ?>
