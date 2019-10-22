-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 
-- サーバのバージョン： 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dictionary`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `d_main`
--

CREATE TABLE `d_main` (
  `d_id` int(11) NOT NULL,
  `l_id` int(11) NOT NULL,
  `upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keyword` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `code` text NOT NULL,
  `bkm` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `d_main`
--

INSERT INTO `d_main` (`d_id`, `l_id`, `upload`, `keyword`, `content`, `code`, `bkm`) VALUES
(1, 1, '2018-10-03 09:02:54', 'test1', 'test1', '', 1),
(3, 2, '2018-10-02 05:29:43', 'test2', 'test2', '', 1),
(4, 3, '2018-10-03 11:27:01', 'echo関数', 'echoの次に書かれた文字をそのまま画面出力する関数。文字だけでなくタグも出力出来る。パラメータの丸括弧phpでは省略できる。丸括弧使わないといけないのは戻り値を戻して利用するというシーンだけ。echoはもともと戻り値ないので丸括弧省略して書くこと多い。\r\n', 'echo \"ようこそ{$_POST[\"u_name\"]}さん。\";', 1),
(5, 3, '2018-10-03 12:33:43', '変数とスーパーグローバル変数', 'PHPの変数はvar宣言が必要ない。その分、先頭に必ず$を入れる必要がある。for文の中の変数iも$iと書くこと。通常変数はページ間でのデータ受け渡しはできない。\r\nPHPにおいて一番重要なのは、ページとページの記憶をどうやって繋いでいくか。そのために使えるのがスーパーグローバル変数。これはどのページからでも参照出来る特別な変数。大文字なのが特徴。$_POST,$_GET,$_SESSION,＄_FILESなどがある。\r\n', '', 1),
(6, 5, '2018-10-01 00:55:14', 'CSR', 'Corporate Social Responsibilityの略。企業が社会に対して果たすべき責任を意味する。', '', 0),
(7, 5, '2018-10-02 05:29:48', 'ステークホルダ', '企業の経営活動にかかわる利害関係者のこと。株主や投資家だけでなく、従業員や取引先、消費者なども含まれる。', '', 1),
(10, 5, '2018-10-03 08:05:55', '職能別組織(機能別組織)', '製造、営業、販売、経理、人事などの職業能力別に構成された組織のこと。', '', 1),
(11, 3, '2018-10-03 13:25:26', '$_POSTと$_GET', 'どこからでも参照出来る特別な変数。ファイル間をまたがって記憶を引き継ぐことが出来る。\r\nPOSTで送られたデータは「$_POST」という変数に、GETで送られたデータは「$_GET」という変数に値が全て配列(連想配列)で格納されるため、連想配列へのアクセスの仕方でデータを取り出す。配列のインデックス(ラベル、項目名)は送信元のinput要素についているname(属性)になる。a要素でリンク先にパラメータが含まれたものを指定した場合も、$_GETで値を受け取ることが出来る。\r\n', '①name属性u_nameとjobを受け取る。\r\n$_POST[\"u_name\"];\r\n$_POST[\"job\"];\r\n\r\n②パラメータ付きURLの値を受け取って表示\r\n★パラメータ付きURL\r\n<p>\r\n	<a href=\"exec1.php?u_name=みき&job=看護師\">ページを移動します。\r\n</p>\r\n\r\n★↑の値を受け取って表示\r\necho $_GET[\"u_name\"];\r\necho $_GET[“job”];\r\n', 1),
(12, 1, '2018-10-03 13:25:11', 'form要素', '▼form要素の中に必要な属性は2つある。\r\n【method】\r\ngetとpostの2種類がある。getはurlにパラメータが全部書かれる送り方。長いものを送る時はpostを使う。デフォルト値はget。\r\n【action】 \r\nデータの送り先。データを受け取って処理をするプログラムのパスを書く(通常相対パス)。action属性を空にすると現在のページが受け取り手になる = 自分で処理する。\r\n\r\n▼form内の要素に関する注意事項\r\n①送信するデータ(input要素etc)には必ずname属性で名前を付けておくこと。\r\nデータベースにおけるカラムの名前(データ挿入先)とname属性の名前は同じに統一しておくとわかりやすい。\r\n②name属性を付けなくてもいいのはsubmitボタン。\r\nただし同じフォームの中に複数のボタンがあって、押されたものを検知してそれぞれ挙動を変えるとき(例えば登録、編集、削除など)はname属性を付けておく必要がある。\r\n', '例①\r\n<form method=”get” action=”exec1.php”>\r\n	<table>\r\n		<tr>\r\n			<th><input type=”text” name=”u_name” id=”u_name”><label for=”u_name”>名前</label></th>\r\n			<td><input type=”text” name=”work” id=”work”><label for=”work”>職業</label></td>\r\n		</tr>\r\n	</table>\r\n	<p><input type=”submit” value=”送信”></p>\r\n</form>\r\n\r\n例②\r\n<form method=\"post\" action=\"test2.php\">\r\n　　　　<p><input type=\"text\" name=\"pref\"></p>\r\n	<p><input type=\"text\" name=\"city\"></p>\r\n	<p><input type=\"submit\" name=\"s1\" value=\"送信\"></p>\r\n	<p><input type=\"submit\" name =\"s2\" value=\"削除\"></p>\r\n</form>\r\n', 1),
(13, 1, '2018-10-03 13:16:46', 'checkボックスとradioボタンの注意点', '▼チェックボックス\r\n注意点はname属性を配列にしておくこと。\r\n▼ラジオボタン\r\n択一にするためname属性は全て同じにすること。\r\n', '', 0),
(14, 3, '2018-10-03 13:37:33', 'パラメータ付きURL', 'アドレスのあとに?で「名前=値」の形でパラメータを指定する。２つ以上付け加える場合は&でつなぐ。\r\nリンクもget通信のため、$_GET[“名前”]でパラメータを受け取ることが出来る。\r\n\r\n', '①パラメータ付きのリンク\r\n<p><a href=\"exec1.php?u_name=みき&job=看護師\">ページを移動します。</p>\r\n\r\n②パラメータ付きのナビを作り、値を受け取ったら処理を変える\r\n★ナビにリンク付きパラメータを生成する\r\n<ul class=\"flex\">\r\n<?php while($row = $lng->fetch(PDO::FETCH_ASSOC)): ?>\r\n　<li id=\"nav<?php echo $row[\"l_id\"]; ?>\">\r\n　　<a href=\"index.php?num=<?php echo $row[\"l_id\"]; ?>\"><?php echo $row[\"l_name\"]; ?></a>\r\n　</li>\r\n<?php endwhile; ?>\r\n</ul>\r\n\r\n★パラメータnumを受け取って空じゃなければの処理\r\nif(!empty($_GET[\"num\"])) {\r\n　include_once(\"config.php\");\r\n　$sql = \"SELECT * FROM lang WHERE l_id = :num;\";\r\n　$stmt = $pdo->prepare($sql);\r\n　$stmt->bindValue(\":num\", $_GET[\"num\"], PDO::PARAM_INT);\r\n　$stmt->execute();\r\n　$tg = $stmt->fetch(PDO::FETCH_ASSOC);\r\n　$title = $tg[\"l_name\"];\r\n　　　<以下省略>\r\n}', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `lang`
--

CREATE TABLE `lang` (
  `l_id` int(11) NOT NULL,
  `l_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `lang`
--

INSERT INTO `lang` (`l_id`, `l_name`) VALUES
(1, 'HTML&CSS'),
(2, 'JavaScript'),
(3, 'PHP'),
(4, 'JAVA'),
(5, 'ITパスポート');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_main`
--
ALTER TABLE `d_main`
  ADD PRIMARY KEY (`d_id`,`keyword`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`l_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_main`
--
ALTER TABLE `d_main`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
