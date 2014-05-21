<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿&一覧</title>
    <link rel="stylesheet" href="/css/csssample.css">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="/js/tweet.js"></script>
</head>
<body>
    <div class = "header">
        <ul>
            <li><?php echo $username?></li>
            <?php echo form_open('logout/index') ?>
            </li><?php echo form_submit('logout', 'ログアウト')?><br /></li>
            </form>
        </ul>
    </div>

    <div class = "sending">
        <h2>ツイート画面</h2>
            <?php echo form_open('tweet/new_tweet') ?>
            <input id="tweet_area" type="textarea" name="tweet" />
            <button id="tweet_button" name="tweet_button">ツイート</button><br />
            </form>
    </div>

    <div class = "tweet">
        <div id="new_tweet"></div>
        <!--<?php if ($now_tweet != false): ?>
            <div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">
                <?php echo $username?><br />
                <?php echo $now_tweet?><br />
                <?php echo $now_register_date?>
            </div>
        <?php endif; ?>-->
        <?php foreach ($news as $item): ?>
	        <div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">
                <?php echo $username?><br />
                <?php echo $item['tweet']?><br />
                <?php echo $item['register_date']?>
            </div>
        <?php endforeach; ?>
        <div id="more_tweet"></div>
        <input id="more_button" type="submit" name="more_button" value="もっと見る" />
    </div>

</body>
</html>