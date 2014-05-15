<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-31J" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="ref/shop.css" rel="stylesheet" type="text/css" />
<script>
$(function() {
     $('#nav li a').mouseover(
        function(){
            $(this).stop()
                .animate({marginLeft:'20px'},{duration:150, queue: true})
                .animate({marginLeft:'0px'},{duration:150, queue: true});
        }
    );

	$('#nav a')
    //ボタンを-200で配置
    .each(function(){
        $(this).css('margin-left', '0px')
    })
    .hover(
        function(){
            $(this).stop().animate({
                'marginLeft':'50px'
            },'fast');
        },
        function () {
            $(this).stop().animate({
                'marginLeft':'0px'
            },'slow');
        }
    );

});
</script>





<title>テスト</title>
</head>
<body>

<?php
 include 'ref/header.php';
?>
<?php
 include 'ref/leftMenu.php';
?>





<div id="box">
たぶんここになんか書きます
</div>






<?php
 include 'ref/favorite.php';
?>
<?php
 include 'ref/footer.php';
?>

</body>
</html>