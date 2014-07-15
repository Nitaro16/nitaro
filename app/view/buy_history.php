<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../ref/css/common.css" type="text/css" charset="utf-8"/>
<script type="text/javascript" src="../ref/js/hidden.js" charset="UTF-8"></script>
<title>購入履歴一覧画面</title>
</head>
<body>
	<?php
		//パスの設定
		require_once('include_path.php');
		require_once('ipath.php');
		//パーツ導入
		require_once('header_menu.php');
		require_once('left_menu.php');

		
		echo '<div id="footer"><dl id="acMenu">';

		//require_once('session_start.php');
		if(isset($_SESSION['user_id'])) {
			//会員である場合
			//データベースへ接続
			require_once('db.php');
			$user_id = $_SESSION['user_id'];
			
			//SQL文を格納、実行、結果を格納
			$sql = "SELECT * FROM item I INNER JOIN genre G ON I.gno = G.gno
					INNER JOIN line L ON L.ino = I.ino
					INNER JOIN buy B ON L.ono = B.ono
					where B.mno = '$user_id' order by B.odate desc";
			$result = mysqli_query($dbc,$sql);
			mysqli_close($dbc);
			// 取得したデータを一覧表示
			if(mysqli_num_rows($result) == 0) {
				//購入履歴が1件も無い場合
				echo "購入履歴がありません。";
				echo '<a href="index.php">トップへ戻る</a>';
			} else {
				//購入履歴がある場合
				$first_flg = 0;
				$old_date = 0;
				while($row = mysqli_fetch_array($result)) {
					//SQLの結果からデータを取得
					$item_id = $row['ino'];
					$item_name = $row['iname'];
					$genre_id = $row['gno'];
					$genre_name = $row['gname'];
					$item_price = $row['lprice'];
					$line_sum = $row['lsum'];
					$line_pt = $row['lpt'];
					$order_date = $row['odate'];
					$order_sum = $row['osum'];
					
					//表示処理
					//初回かどうかの判断
					if($first_flg = 0) {
						//初回ならば表示する
						echo '<dt>購入日：' . $order_date ;
						echo '  合計金額：' . $order_sum . '円</dt>';
					} else if($old_date == $order_date) {
						//同一の注文票ならば表示しない
					} else {
						//別の注文票ならば表示する
						echo '<dt>購入日：' . $order_date ;
						echo '  合計金額：' . $order_sum . '円</dt>';
					}
					$first_flg = 1;
					$old_date = $order_date;
					
					echo '<dd><a href="item.php?item_id=' . $item_id . '">' . $item_name . '</a>';
					echo '<a href="item_select.php?genre_id=' . $genre_id . '">' . $genre_name . '</a><br />';
					echo '購入価格：' . $item_price . '円<br />';
					echo '購入数量：' . $line_sum . '<br />';
					echo '小計：' . $item_price * $line_sum . '円<br />';
					echo '発生ポイント：' . $line_pt . '<br />';
					echo '<br /></dd>';
				}
				echo '</dl></div>';
				$count = 0;
				echo '<a href="index.php">トップへ戻る</a>';
			}
		} else {
			//会員でない場合
			echo '会員専用ページとなっております。';
			echo 'ログインしてからもう一度アクセスしてください。';
		}
		//パーツ導入
		//require_once('ranking_menu.php');
		require_once('footer_menu.php');
	?>
</body>
</html>