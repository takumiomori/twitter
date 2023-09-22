<?php session_start(); ?>
<?php 
if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
    echo 'ログアウトしました。';
    echo '<br><a href="twitter-login-input.php">別アカウントでログイン</a><br>';
    echo '<a href="twitter-signin-input.php">アカウントを新規登録</a>';
}else{
echo 'すでにログアウトしています。';
}
?>