<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿&一覧</title>
    <link rel="stylesheet" href="/css/tweet.css">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="/js/tweet.js"></script>
</head>
<body id="body">
    <div class = "header">
        <ul>
            <li><?php echo $username?></li>
            <?php echo form_open('logout/index') ?>
            </li><?php echo form_submit('logout', 'ログアウト')?><br /></li>
            </form>
        </ul>
    </div>

    <h2>ツイート画面</h2>
    <div class = "sending">
            <?php $attributes = array('id' => 'form_tweet_area')?>
            <?php echo form_open('tweet/new_tweet', $attributes) ?>
                <textarea id="tweet_area" name="tweet_area" value="" rows="4" cols="40" maxlength="139"></textarea>
                <button id="tweet_button" name="tweet_button">ツイート</button><br />
            </form>
    </div>

    <div class = "tweet">
        <div id="new_tweet"></div>
        <?php foreach ($news as $key => $item): ?>
	        <div style="background-color: #FFF; padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">
                <?php echo $username?><br />
                <?php echo $item['tweet']?><br />
                <?php echo $item['unix_time']?>
            </div>
        <?php endforeach; ?>
        <div id = "more_tweet"></div>
        <div id = "more_button_area">
            <input id="more_button" type="button" name="more_button" value="もっと見る">
        </div>
        <input id="page" type="hidden" name="page" value="0">
        <input type="hidden" value="<?php echo $button ?>" id="button"/>
    </div>
</body>
</html>