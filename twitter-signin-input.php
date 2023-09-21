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
$accountid=$username=$password='';
if(isset($_SESSION['user'])){
    $accountid=$_SESSION['user']['accountid'];
    $username=$_SESSION['user']['username'];
    $password=$_SESSION['user']['password'];
}

echo '<form action="twitter-signin-output.php" method="post">';
echo '<table>';
echo '<tr><td>アカウントID</td><td>';
echo '<input type="text" name="accountid" value="',$accountid,'">';
echo '</td></tr>';
echo '<tr><td>ユーザ名</td><td>';
echo '<input type="text" name="username" value="',$username,'">';
echo '</td></tr>';
echo '<tr><td>パスワード</td><td>';
echo '<input type="password" name="password" value="',$password,'">';
echo '</td></tr>';
echo '</table>';
echo '<input type="hidden" name="token" value="',htmlspecialchars($token,ENT_COMPAT,'UTF-8'),'">';
echo '<input type="submit" value="登録">';
echo '</form>';
?>
