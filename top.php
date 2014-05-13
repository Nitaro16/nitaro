<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-31J" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="shop.css" rel="stylesheet" type="text/css" />

<script>
$(function() {
   $('#nav').hover(
    function(){
      $(this).find('span').stop().animate({'marginRight':'175px'},500);
    },
    function () {
      $(this).find('span').stop().animate({'marginRight':'0px'},300);
    }
  );
});
</script>





<title>テスト</title>
</head>
<body>

<?php
 include 'header.php';
?>
<?php
 include 'left_menu.php';
?>





<div id="box">
たぶんここになんか書きます
</div>






<?php
 include 'favorite.php';
?>
<?php
 include 'footer.php';
?>

</body>
</html>