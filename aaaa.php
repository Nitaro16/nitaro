<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-31J" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="shop.css" rel="stylesheet" type="text/css" />

<script>
$(function() {
     $('#nav9 li a').mouseover(
        function(){
            $(this).stop()
                .animate({marginLeft:'20px'},{duration:150, queue: true})
                .animate({marginLeft:'0px'},{duration:150, queue: true});
        }
    );
});

</script>

<title>テスト</title>
</head>
<body>

<ul id="nav9">
    <li><a href="#">HOME</a></li>
    <li><a href="#">ABOUT</a></li>
    <li><a href="#">GALLERY</a></li>
    <li><a href="#">LINK</a></li>
</ul>






</body>
</html>