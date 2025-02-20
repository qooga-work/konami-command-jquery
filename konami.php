<?php
// Cookie消す処理
if(isset($_REQUEST['delete_cookie'])){
    // Chrome 80
    setcookie('konamiCMD', '', time() - 1800, '/; SameSite=None;', null, true, false);
    header('Location: ./konami.php', true , 301);
}
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>コナミコマンドテスト</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="./favicon.ico" />
<script src="./jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="./dist/jquery.konami.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
    var mySet = [];
    mySet.wordOn = 'ON！！';
    mySet.wordOff = 'OFF！！';
    mySet.checkCookie = function(flag=0){
        var tc = document.cookie.split(';');
        var readCookie = [];
        tc.forEach(function(value) { 
          //cookie名と値に分ける
          var ts = value.split('=');
          readCookie[ts[0]] = ts[1];
        });
        if(!readCookie.konamiCMD){
            return mySet.end(flag);
        }else if(readCookie.konamiCMD == 0){
            return mySet.end(flag);
        }else{
            return mySet.start(flag);
        }
    };

    // 起動時オプション例
    mySet.start = function(flag=0){
        $('.set_now').text(mySet.wordOn);
        $('body').addClass('konami_on');
        if(flag==0)
          alert("コナミコマンド発動！");
    };
    // 停止時オプション例
    mySet.end = function(flag=0){
        $('.set_now').text(mySet.wordOff);
        $('body').removeClass('konami_on');
        if(flag==0)
          alert("コナミコマンド停止！");
    };


    $('body').konami({
      onFunction: function(){mySet.start()},
      offFunction: function(){mySet.end()},
    });
    mySet.checkCookie(1);
});
</script>
<link href="./style.css" rel="stylesheet">
</head>
<body>

<h1>コナミコマンドセット例</h1>

<p>Cookie内容の表示とCookie削除以外は、jQueryだけで処理しています。</p>


<h2>現在の状態</h2>
<span class="set_now"></span>


<h2>Cookieの内容</h2>
<div class="cookie_check">
<pre><?php
if(isset($_COOKIE)){
  print_r($_COOKIE);
}else{
  echo 'cookieナシ';
}
?></pre>
</div>

<form method="post" action="./konami.php">
<input type="submit" name="delete_cookie" class="button" value="Cookieを消す">
</form>


<h2>入力テストのための無意味なフォーム</h2>
<form method="post" action="./konami.php">
<input type="text" value="" placeholder="意味はないINPUT" ><br />
<textarea cols="50" rows="5" placeholder='KONAMIコマンドは『↑↑↓↓←→←→BA』
form内で打ち込んだ場合も有効になります。'></textarea>
</form>

<a href="./">説明ページへ戻る</a>

<div class="ninja_onebutton">
<script type="text/javascript">
//<![CDATA[
(function(d){
if(typeof(window.NINJA_CO_JP_ONETAG_BUTTON_eb03a8ac3330de6bdd3765b02ec70a7e)=='undefined'){
    document.write("<sc"+"ript type='text\/javascript' src='\/\/omt.shinobi.jp\/b\/eb03a8ac3330de6bdd3765b02ec70a7e'><\/sc"+"ript>");
}else{
    window.NINJA_CO_JP_ONETAG_BUTTON_eb03a8ac3330de6bdd3765b02ec70a7e.ONETAGButton_Load();}
})(document);
//]]>
</script><span class="ninja_onebutton_hidden" style="display:none;"></span><span style="display:none;" class="ninja_onebutton_hidden"></span>
</div>

<address><a href="https://qooga.jb-jk.net/" target="_blank">©クーガキカク</a></address>
</body>
</html>
