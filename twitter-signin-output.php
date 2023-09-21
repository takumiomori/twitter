<?php session_start(); ?>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=practice;charset=utf8', 'root' , 'mariadb');
if(isset($_SESSION['user'])){
    $id=$_SESSION['user']['id'];
    $sql=$pdo->prepare('select * from post_user where id!=? and accountid=?');
    $sql->execute([$id,$_REQUEST['accountid']]);
}else{
    $sql=$pdo->prepare('select * from post_user where accountid=?');
    $sql->execute([$_REQUEST['accountid']]);
}
if(empty($sql->fetchAll())){
    if(isset($_SESSION['user'])){
        $sql=$pdo->prepare('update post_user set accountid=?, username=?, password=? where id=?');
        $sql->execute([$_REQUEST['accountid'],$_REQUEST['username'],$_REQUEST['password'],$id]);
        $_SESSION['user']=['id'=>$id,'accountid'=>$_REQUEST['accountid'],'username'=>$_REQUEST['username'],'password'=>$_REQUEST['password']];
        echo 'アカウント情報を更新しました。';
    }else{
        $sql=$pdo->prepare('insert into post_user values(null,?,?,?)');
        $sql->execute([$_REQUEST['accountid'],$_REQUEST['username'],$_REQUEST['password']]);
        echo 'アカウント情報を登録しました。';
        echo '<a href="twitter-login-input.php">ログイン</a></p>';
    }
}else{
    echo 'アカウントIDが既に使用されています。変更して再度登録してください。';
}
?>
