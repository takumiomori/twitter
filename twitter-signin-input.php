<?php session_start();
if(empty($_SESSION['token'])){
    //このセッション専用のトークンを作る
   $token = bin2hex(openssl_random_pseudo_bytes(24));
   //セッション変数としてトークンを格納
   $_SESSION['token']=$token;
}else{ //トークンがもともとあればそれを使う
   $token = $_SESSION['token'];
} ?>
<?php 
$accountid=$username=$password=$userimage='';
if(isset($_SESSION['user'])){
    $accountid=$_SESSION['user']['accountid'];
    $username=$_SESSION['user']['username'];
    $password=$_SESSION['user']['password'];
    $userimage=$_SESSION['user']['userimage'];
}
echo '<head>
    <link rel="stylesheet" href="css/style.css">
</head>';
echo '<body>';
echo '<div class="signin">';
echo '<div class="inputarea">';
echo '<form action="twitter-signin-output.php" method="post" enctype="multipart/form-data">';
echo '<table>';
echo '<tr><td>アカウントID</td><td>';
echo '<input type="text" class="form" name="accountid" value="',$accountid,'">';
echo '</td></tr>';
echo '<tr><td>ユーザ名</td><td>';
echo '<input type="text" class="form" name="username" value="',$username,'">';
echo '</td></tr>';
echo '<tr><td>パスワード</td><td>';
echo '<input type="password" class="form" name="password" value="',$password,'">';
echo '</td></tr>';
echo '<tr><td>プロフィール画像</td><td>';
echo '<input type="file" class="imagefile" name="file">';
echo '</td></tr>';
echo '</table>';
echo '<input type="hidden" name="token" value="',htmlspecialchars($token,ENT_COMPAT,'UTF-8'),'">';
echo '<input type="submit" class="submitbtn" value="登録">';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</body>';
?>
