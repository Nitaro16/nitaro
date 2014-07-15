<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>会員情報登録画面</title>
		<link rel="stylesheet" href="../ref/css/common.css" type="text/css" charset="utf-8"/>
    <link rel="stylesheet" href="../ref/css/validationEngine.jquery.css" type="text/css"/>
    <link rel="stylesheet" href="../ref/css/form.css" type="text/css"/>
    <script src="http://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3.js" charset="UTF-8"></script>
	<script type="text/javascript" src="../ref/js/jquery.validationEngine-ja.js"></script>
    <script type="text/javascript" src="../ref/js/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="../ref/js/form.js"></script>
</head>
<body>
    <?php
        //パスの設定
        require_once('include_path.php');
        //パーツ導入
        require_once('header_menu.php');
        //require_once('left_menu.php');
        //データベースへ接続
        require_once('db.php');
        //require_once('session_start.php');
        echo '<div id="user_form"><h3>会員情報登録画面</h3>';
        if(!isset($_SESSION['user_id'])) {
            //ユーザがログインしていない場合（非会員状態時）
            if(isset($_POST['fase1']) || isset($_POST['fase2']) || isset($_POST['fase3'])) {
                //確認ボタン、変更ボタン、登録ボタンが押されたとき
                //フォームからデータの取得
                $user_name = $_POST['user_name'];
                $user_mailadd = $_POST['user_mailadd'];
                $user_pw = $_POST['user_pw'];
                $user_post = $_POST['user_post'];
                $user_add = $_POST['user_add'];
                $user_tel = $_POST['user_tel'];
                $user_card = $_POST['user_card'];
                $user_term = $_POST['user_term'];

                //フォームに入力されたデータの判定
                if(/*empty($user_name) || empty($user_mailadd)
					|| empty($user_pw) || empty($user_post) 
					|| empty($user_add) || empty($user_tel) 
					|| empty($user_card) */isset($user_name) && isset($user_mailadd)
                    && isset($user_pw) && isset($user_post)
                    && isset($user_add) && isset($user_tel)
                    && isset($user_card) && isset($user_term)/* || isset($user_name{21})
					|| isset($user_mailadd{41}) || isset($user_pw{16}) 
					|| isset($user_post{9}) || isset($user_add{101}) 
					|| isset($user_tel{14}) || isset($user_card{17})*/) {
                    //通常時
                    $flg = 0;
                } else {
                    //入力項目に誤りがある場合
                    $flg = 1;
                }

                if(isset($_POST['fase1'])) {
                    //確認ボタンが押されたとき
                    echo '<p>以下の内容で登録します。よろしいですか？</p>';
                    echo '<form action="user_entry.php" method="POST">';
                    echo'<h4>名前</h4>' . $user_name . '<input type="hidden" name="user_name" value="' . $user_name . '" /><br>';
                    echo'<h4>メールアドレス</h4>' . $user_mailadd . '<input type="hidden" name="user_mailadd" value="' . $user_mailadd . '" /><br>';
                    echo'<h4>パスワード</h4>' . $user_pw . '<input type="hidden" name="user_pw" value="' . $user_pw . '" /><br>';
                    echo'<h4>郵便番号</h4>' . $user_post . '<input type="hidden" name="user_post" value="' . $user_post . '" /><br>';
                    echo'<h4>住所</h4>' . $user_add . '<input type="hidden" name="user_add" value="' . $user_add . '" /><br>';
                    echo'<h4>電話番号</h4>' . $user_tel . '<input type="hidden" name="user_tel" value="' . $user_tel . '" /><br>';
                    echo'<h4>クレジットカード番号</h4>' . $user_card . '<input type="hidden" name="user_card" value="' . $user_card . '" /><br>';
                    echo'<h4>有効期限</h4>' . $user_term . '<input type="hidden" name="user_term" value="' . $user_term . '" /><br>';
                    echo'<input type="submit" value="変更" name="fase2" />';
                    echo'<input type="submit" value="登録" name="fase3" />';
                    echo'</form>';
                    echo'<a href="index.php">トップへ戻る</a>';
                } else if(isset($_POST['fase2']) || $flg == 1) {
                    //変更ボタンが押されたとき、または入力項目に誤りがあった場合
                    if($flg == 1) {
                        //入力項目に誤りがあった場合
                        echo'<p>入力項目に誤りがあります。</p>';
                    } else {

                    }
                    echo '<form id="user_registration" action="user_entry.php" method="POST">';
                    echo'<h4>名前</h4><input type="text" name="user_name" maxlength="20" class="validate[required]"/><br>';
                    echo'<h4>メールアドレス</h4><input type="text" name="user_mailadd" maxlength="40" class="validate[required,custom[email],ajax[ajaxMailCallPHP]] text-input" /><br>';
                    echo'<h4>パスワード</h4> <span class="exampleText">英数半角8文字以上15文字以内</span><br> <input type="password" name="user_pw" " maxlength="15" id="user_pw" class="validate[required,custom[password]]" /> (英数半角8文字以上15文字以内)<br>';
                    echo'<h4>パスワード（確認）</h4><input type="password" name="user_pwch" class="validate[required,equals[user_pw]]"/><br>';
                    echo'<h4>郵便番号</h4><input type="text" name="user_post" maxlength="7" class="validate[required,custom[zip]]" onKeyUp="AjaxZip3.zip2addr(this,\'\',\'user_add\',\'user_add\');" /><br>';
                    echo'<h4>住所</h4><input type="text" name="user_add"  class="validate[required]" /><br>';
                    echo'<h4>電話番号</h4><input type="text" name="user_tel"  class="validate[required,custom[phone]]" /><br>';
                    echo'<h4>クレジットカード番号</h4><input type="text" name="user_card" maxlength="16" class="validate[required,creditCard]" /><br>';
                    echo'<h4>有効期限</h4><input type="text" name="user_term" class="validate[required,custom[expirationDate]]" /><br>';
                    echo'<input type="submit" value="確認" name="fase1" />';
                    echo'</form>';
                    echo'<a href="index.php">トップへ戻る</a>';
                } else if(isset($_POST['fase3'])) {
                    //登録ボタンが押されたとき
                    //（※実装時はテーブル名の修正が必要）
                    $query = "select mmail from member where mmail = '$user_mailadd'";
                    $result = mysqli_query($dbc, $query);

                    if(mysqli_num_rows($result) == 1) {
                        //mailの重複時の処理
                        echo '入力されたメールドレスは既に使われています。<br />';
                    } else {
                        //通常時の処理
                        //SQL文格納（INSERT）（※実装時はテーブル名の修正が必要）
                        $query = "INSERT INTO member(mpass, mmail, mname, mpost, maddress, mtel, mcard, mterm)
								VALUE ('$user_pw', '$user_mailadd', '$user_name', '$user_post', '$user_add', '$user_tel', '$user_card', '$user_term')";
                        //SQL文実行
                        $result = mysqli_query($dbc, $query);

                        //自分自身を検索
                        $query = "select mmail from member where mmail = '$user_mailadd' and mpass = '$user_pw'";
                        $result = mysqli_query($dbc, $query);

                        //データベースとの接続を切断
                        mysqli_close($dbc);
                        //会員登録ができているかの確認
                        if(!mysqli_num_rows($result) == 1) {
                            //insert処理失敗時の処理
                            echo 'データの登録に失敗しました。しばらくお待ちの上再度お試し下さい。<br />';
                        } else {
                            //処理完了とお知らせ
                            echo'<p>会員情報の登録が完了しました。</p>';
                            echo'<p>トップページへ戻り、ログインしてください。</p>';
                        }
                    }
                    //トップ画面へのリンク
                    echo'<a href="index.php">トップへ戻る</a>';
                }
            } else {
                //初回アクセス時
                echo '<form id="user_registration" action="user_entry.php" method="POST">';
                echo'<h4>名前</h4><input type="text" name="user_name" maxlength="20" class="validate[required]"/><br>';
                echo'<h4>メールアドレス</h4><input type="text" name="user_mailadd" maxlength="40" class="validate[required,custom[email],ajax[ajaxMailCallPHP] text-input" /><br>';
                echo'<h4>パスワード</h4> <span class="exampleText">英数半角8文字以上15文字以内</span><br> <input type="password" name="user_pw" " maxlength="15" id="user_pw" class="validate[required,custom[password]]" /><br>';
                echo'<h4>パスワード（確認）</h4><input type="password" name="user_pwch" class="validate[required,equals[user_pw]]"/><br>';
                echo'<h4>郵便番号</h4> <span class="exampleText">ハイフン(-)なし 例：1600000</span><br> <input type="text" name="user_post" maxlength="7" class="validate[required,custom[zip]]" onKeyUp="AjaxZip3.zip2addr(this,\'\',\'user_add\',\'user_add\');" /><br>';
                echo'<h4>住所</h4><input type="text" name="user_add"  class="validate[required]" /><br>';
                echo'<h4>電話番号</h4> <span class="exampleText">ハイフン(-)なし 例：0120000222</span><br> <input type="text" name="user_tel"  class="validate[required,custom[phone]]" /><br>';
                echo'<h4>クレジットカード番号</h4> <span class="exampleText">ハイフン(-)なし</span><br> <input type="text" name="user_card" maxlength="16" class="validate[required,creditCard]" /><br>';
                echo'<h4>有効期限</h4><span class="exampleText">月/年で入力 例：07/14</span><br><input type="text" name="user_term" class="validate[required,custom[expirationDate]]" /><br>';
                echo'<input type="submit" value="確認" name="fase1" />';
            echo'</form>';
        }
        } else {
            //ユーザがログイン状態であるとき（会員状態時）
            echo '<p>既に会員であるため、この操作を行うことができません。</p>';
            echo '<a href="index.php">トップへ戻る</a>';
        }
        //パーツ導入
        echo('</div>');
        //require_once('ranking_menu.php');
        require_once('footer_menu.php');
    ?>
</body>
</html>
