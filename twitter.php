<?php session_start(); ?>
<?php
if(isset($_SESSION['user'])){
echo '<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />
    <script src="https://kit.fontawesome.com/ac579a8dbe.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <section class="left">
        <h1><i class="fa-brands fa-twitter fa-2x" style="color: #1d9bf0;"></i></h1>
        <div class="search_topics"><i class="fa-solid fa-magnifying-glass size_left" style="color: #0f1419;"></i>
            <p class="left_copy search">話題を検索</p>
        </div>
        <div class="setting"><i class="fa-solid fa-gear size_left" style="color: #0f1419;"></i>
            <p class="left_copy setting">設定</p>
        </div>
        
            <a href="twitter-logout-output.php"><p class="left_copy logout">ログアウト</p></a>
        
    </section>
    <section class="center">
        <div class="center_head">
            <div class="center_tittle">話題を検索</div>
            <div class="center_setting"><i class="fa-solid fa-gear size_center" style="color: #0f1419;"></i></div>

        </div>
        <div class="postarea">
            <form action="twitter.php" method="post">
                <input type="hidden" name="command" value="insert">

                <div class="posting"><textarea name="tweet" class="textbox">いまどうしてる？</textarea></div><br>
                <div class="submit"><input class="tweetbuttun" type="submit" value="ツイート"><br></div>
            </form>
        </div>
        <div class="sortarea">
                <form action="twitter.php" method="post">
                <input type="hidden" name="sort">
                <div class="sort"><input type="submit" value="並べ替え">
            </form>
            </div>
        </div>
        


        <div class="tweet_wrap">';


                $pdo = new PDO('mysql:host=localhost;dbname=practice;charset=utf8', 'root', 'mariadb');

                if (isset($_REQUEST['command'])) {
                    switch ($_REQUEST['command']) {
                        case 'insert':
                            $sql = $pdo->prepare('insert into post values(null,?,?,0,?)');
                            $sql->execute(
                                [$_REQUEST['tweet'],date('Y/m/d H:i:s'),$_SESSION['user']['id']]
                            );
                            break;
                        case 'update':
                            $sql = $pdo->prepare('update post set good=good + 1 where post_id=?');
                            $sql->execute([$_REQUEST['id']]);
                            break;
                }
            }
                if (isset($_REQUEST['sort'])) {
                    foreach ($pdo->query('select * from post,post_user where user_id=post_user.id order by post.post_id desc') as $row) {
                            echo '<div class="center_tweet"gーグル>
                            <div class="tweet_icon"><img src="images/';
                            echo $row['userimage'];
                            echo '" alt=""></div>
                            <div class="tweet_area">
                                <div class="user_info">
                                    <div class="account_name">';
                            echo $row['username'];
                            echo '</div>
                                    <div class="account_id">';
                            echo '@',$row['accountid'];
                            echo '</div>
                                    <div class="post_time">';
                                    echo $row['time'];
                                    echo '</div>
                                </div>
                                <div class="tweet_text">';
                            echo $row['tweet'];
                            echo '</div>
                    <div class="tweet_image">
                    </div>
                    <div class="tweet_impression">
                        <div class="comments"><i class="fa-regular fa-comment impression_i"></i>---</div>
                        <div class="retweet"><i class="fa-solid fa-retweet impression_i"></i>---</div>
    
                        <div class="good"><i class="fa-regular fa-heart impression_i"></i>
                        
                        <form action="twitter.php" method="post">
                            <input type="hidden" name="command" value="update">
                        <input type="hidden" name="id" value="', $row['post_id'],'">
                    <input class="goodbuttun" type="submit" name="good" value="いいね">
                </form>
                            <div class="good_count">';
                            echo $row['good'];
                            echo '</div>
    
                        </div>
                        <div class="total_impression"><i class="fa-solid fa-signal impression_i"></i>---</div>
                    </div>
                    </div>
                    </div>
                    ';
                    }
                }else{
                    foreach ($pdo->query('select * from post,post_user where user_id=post_user.id') as $row) {
                        echo '<div class="center_tweet">
                        <div class="tweet_icon"><img src="images/';
                        echo $row['userimage'];
                        echo '" alt=""></div>
                        <div class="tweet_area">
                            <div class="user_info">
                                <div class="account_name">';
                        echo $row['username'];
                        echo '</div>
                                <div class="account_id">';
                        echo '@',$row['accountid'];
                        echo '</div>
                                <div class="post_time">';
                                echo $row['time'];
                                echo '</div>
                            </div>
                            <div class="tweet_text">';
                        echo $row['tweet'];
                        echo '</div>
                <div class="tweet_image">
                </div>
                <div class="tweet_impression">
                    <div class="comments"><i class="fa-regular fa-comment impression_i"></i>---</div>
                    <div class="retweet"><i class="fa-solid fa-retweet impression_i"></i>---</div>

                    <div class="good"><i class="fa-regular fa-heart impression_i"></i>
                    
                    <form action="twitter.php" method="post">
                        <input type="hidden" name="command" value="update">
                    <input type="hidden" name="id" value="', $row['post_id'],'">
                <input class="goodbuttun" type="submit" name="good" value="いいね">
            </form>
                        <div class="good_count">';
                        echo $row['good'];
                        echo '</div>

                    </div>
                    <div class="total_impression"><i class="fa-solid fa-signal impression_i"></i>---</div>
                </div>
                </div>
                </div>
                ';
    
                    echo "\n";
                }
                }
            }else{
                echo 'サービスの利用にはログインする必要があります。';
                echo '<a href="twitter-login-input.php">ログイン</a></p>';
                echo 'アカウントをお持ちでない方は';
                echo '<a href="twitter-signin-input.php">アカウント登録</a></p>';
            }
            ?>
        </div>
    </section>
    <section class="right">

    </section>
</body>


</html>