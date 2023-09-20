<?php session_start(); ?>
<?php 
if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
    echo 'ログアウトしました。';
}else{
echo 'すでにログアウトしています。';
}
?>