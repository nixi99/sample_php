<?php
include_once("config.php");
$_SESSION["lng"] = [];
if(empty($_SESSION["lng"])) {
	$sql ="SELECT * FROM lang;";
	$lng = $pdo->query($sql);
	$les = [];
}
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>プログラミング言語辞典</title>
		<link rel ="stylesheet" href="style.css">
		<meta name="viewport" content="width=device-width">
	</head>
	<body>
		<div id="container">
			<header>
				<h1>プログラミング言語辞典</h1>
				<nav>
					<ul class="flex">
					<?php if(empty($_SESSION["lng"])) : ?>
						<?php while($row = $lng->fetch(PDO::FETCH_ASSOC)): ?>
						<li id="nav<?php echo $row["l_id"]; ?>">
							<a href="index.php?num=<?php echo $row["l_id"]; ?>"><?php echo $row["l_name"]; ?></a>
						</li>
						<?php $les += [$row["l_id"]=>$row["l_name"]]; ?>
						<?php endwhile; ?>
							<?php $_SESSION["lng"] = $les; ?>
					<?php else: ?>
						<?php foreach($_SESSION["lng"] as $key=>$val): ?>
							<li id="nav<?php echo $key; ?>">
								<a href="index.php?num=<?php echo $key; ?>"><?php echo $val; ?></a>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
						<li> <a href="index.php">編集メニュー</a></li>
					</ul>
				</nav>
			</header>

