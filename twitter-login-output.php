<?php session_start(); ?>

<?php 
unset($_SESSION['user']);
$pdo=new PDO('mysql:host=localhost;dbname=practice;charset=utf8','root','mariadb');
$sql=$pdo->prepare('select * from post_user where accountid=? and password=?');
$sql->execute([$_REQUEST['accountid'],$_REQUEST['password']]);
foreach($sql as $row){
    $_SESSION['user']=[
        'id'=>$row['id'],'accountid'=>$row['accountid'],'username'=>$row['username'],'password'=>$row['password'],
    ];
}
if(isset($_SESSION['user'])){
    echo 'ようこそ、',$_SESSION['user']['username'],'さん。';
    echo '<a href="twitter.php">Twitterをはじめる</a></p>';
  exit;
}else{
    echo 'アカウントIDまたはパスワードが違います。';
}
 ?>
