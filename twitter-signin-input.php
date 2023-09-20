<?php session_start(); ?>
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
echo '<input type="submit" value="登録">';
echo '</form>';
?>
