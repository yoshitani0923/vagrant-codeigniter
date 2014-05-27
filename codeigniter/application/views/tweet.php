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
            <input id="tweet_area" type="textarea" name="tweet" value=""/>
            <button id="tweet_button" name="tweet_button">ツイート</button><br />
            </form>
    </div>

    <div class = "tweet">
        <div id="new_tweet"></div>
        <?php foreach ($news as $key => $item): ?>
	        <div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">
                <?php echo $username?><br />
                <?php echo $item['tweet']?><br />
                <?php echo $unix_time[$key]?>
            </div>
        <?php endforeach; ?>
        <div id="more_tweet"></div>
        <input id="more_button" type="button" name="more_button" value="もっと見る" />
        <input id="page" type="hidden" name="page" value="0">
    </div>

</body>
</html>