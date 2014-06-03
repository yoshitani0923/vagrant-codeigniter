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
    <?php $attributes = array('id' => 'form_tweet_area')?>
    <?php echo form_open('tweet/new_tweet', $attributes) ?>
        <textarea id="tweet_area" name="tweet_area" value="" rows="4" cols="40" maxlength="139"></textarea>
        <button id="tweet_button" name="tweet_button">ツイート</button><br />
    </form>
    
    <!--新規ツイート表示-->
    <div id="new_tweet">
        <!--<div id="template" name ="template">
            <div id="temp_username"><?php echo $username?><br/></div>
            <div id="temp_tweet"><?php echo $item['tweet']?><br/></div>
            <div id="temp_unix_time"><?php echo $item['unix_time']?></div>
        </div>-->
    </div>

    <!--10件のツイート表示-->
    <?php foreach ($news as $key => $item): ?>
        <div style="background-color: #FFF; padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">
            <div id="username"><?php echo $username?><br /></div>
            <div id="tweet"><?php echo $item['tweet']?><br /></div>
            <div id="unix_time"><?php echo $item['unix_time']?></div>
        </div>
    <?php endforeach; ?>

    <!--もっと見る-->
    <div id="more_tweet"></div>
    <div id="more_button_area">
        <input id="more_button" type="button" name="more_button" value="もっと見る">
    </div>

    <!--もっと見るボタン表示/非表示判断要素-->
    <div id="appear">
        <input id="page" type="hidden" name="page" value="0">
        <input type="hidden" value="<?php echo $button ?>" id="button"/>
    </div>

    <!--テンプレートとして使用-->
    <div class="template" name ="template">
        <div class="temp_username"><br/></div>
        <div class="temp_tweet"><br/><br /></div>
        <div class="temp_unix_time"></div>
    </div>
</body>
</html>