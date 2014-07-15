<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../ref/css/reset.css">
<link rel="stylesheet" href="../ref/css/style.css" media="screen" type="text/css" />
<script src="../ref/js/index.js" type="text/javascript" charset="utf-8"></script>
<title>商品ランキング画面</title>
</head>
<body>
	<?php
	echo '<div id="ranking">';
	echo '<p>売上ランキングTOP3</p>';
		//データベースに接続
		require_once('include_path.php');
		//画像データへのパスを取得
		require_once('ipath.php');
		if(!isset($_SESSION['item_ranking'])) {
			//セッションに商品ランキング情報を格納していない場合（初回アクセス時）
			//データベースに接続
			require_once('db.php');
			//SQL文生成、実行、接続切断
			$dbc = mysqli_connect(db_host, db_user, db_pass, db_name);
			$query = "SELECT * 
						FROM item, line 
						WHERE item.ino = line.ino 
						GROUP BY item.ino 
						ORDER BY sum(line.lsum) DESC, item.iname ASC 
						LIMIT 3";
			$result0 = mysqli_query($dbc, $query);
			mysqli_close($dbc);
			//取得したデータをセッションに格納、及び表示
			while($row0 = mysqli_fetch_array($result0)) {
				$item_id = $row0['ino'];
				$item_name = $row0['iname'];
				$item_price = $row0['iprice'];
				$item_img = $row0['iimg'];
				
				/*echo '<article class="entry"><a><aside>';
				echo '<a href="item.php?item_id=' . $item_id . '"></a>';
				*/
				echo '<article class="entry">';
					echo '<a href="item.php?item_id=' . $item_id . '">';
						echo '<aside>';
							echo '<strong>' . $item_name . '</strong>';
							echo '<p>' . $item_price . '</p>';
						echo '</aside>';
					echo '<img src="' . ipath . $item_img . '" /*alt="' . $item_name . '*/"width="300" height="300" /><i></i></a>';
					echo '<ul>';
					echo '<li style="background-color:#8dcf0a"></li><li style="background-color:#5a9619"></li><li style="background-color:#2c2c2c"></li>';
					echo '</ul>';
				echo '</article>';
				//表示
				
				//格納
				$_SESSION['item_ranking'][$item_id] = array(
					'item_id' => $item_id,
					'item_name' => $item_name,
					'item_price' => $item_price,
					'item_img' => $item_img
				);
			}
		} else {
			//セッションに商品ランキング情報が格納されているとき（次回アクセス以降）
			//セッションからデータを取得、表示
			foreach($_SESSION['item_ranking'] as $item_no => $item_ranking) {
				$item_id = $item_ranking['item_id'];
				$item_name = $item_ranking['item_name'];
				$item_price = $item_ranking['item_price'];
				$item_img = $item_ranking['item_img'];
				
				//表示
				echo '<article class="entry">';
					echo '<a href="item.php?item_id=' . $item_id . '">';
						echo '<aside>';
							echo '<strong>' . $item_name . '</strong>';
							echo '<p>' . $item_price . '</p>';
						echo '</aside>';
					echo '<img src="' . ipath . $item_img . '" /*alt="' . $item_name . '*/"width="300" height="300" /></a>';
					echo '<ul>';
					echo '<li style="background-color:#8dcf0a"></li><li style="background-color:#5a9619"></li><li style="background-color:#2c2c2c"></li>';
					echo '</ul>';
				echo '</article>';
			}
		}
	echo '</div>';
	?>
	
</body>
</html>
