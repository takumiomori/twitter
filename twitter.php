<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <div class="submit"><input class="tweetbuttun" type="submit" value="ツイート"></div>
            </form>
        </div>


        <div class="tweet_wrap">
            <?php
            $pdo = new PDO('mysql:host=localhost;dbname=practice;charset=utf8', 'root', 'mariadb');

            if (isset($_REQUEST['command'])) {
                switch ($_REQUEST['command']) {
                    case 'insert':
                        $sql = $pdo->prepare('insert into post values(?)');
                        $sql->execute(
                            [$_REQUEST['tweet']]
                        );
                        break;
                }
            }
            foreach ($pdo->query('select * from post') as $row) {
                echo '<div class="center_tweet">
                <div class="tweet_icon"><img src="images/icon1.jpg" alt=""></div>
                <div class="tweet_area">
                    <div class="user_info">
                        <div class="account_name">犬好き【公式】</div>
                        <div class="account_id">@dog_love</div>
                        <div class="post_time">---</div>
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
                <div class="good_count"></div>
            </div>
            <div class="total_impression"><i class="fa-solid fa-signal impression_i"></i>---</div>
        </div>
        </div>
        </div>
        ';

                echo "\n";
            }

            ?>
        </div>
    </section>
    <section class="right">

    </section>
</body>


</html>