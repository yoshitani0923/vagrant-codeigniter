<html>
<head>

</head>
<body>
    <?php echo $username?>

    <?php echo form_open('logout/index') ?>
    <a><?php echo form_submit('submit', 'ログアウト')?></a><br />
    </form>

    <h2>ツイート画面</h2>

    <?php echo form_open('tweet') ?>
        <?php echo form_textarea('tweet')?><br />
        <input type="submit" name="submit" value="ツイート" />
    </form>

    <?php if ($now_tweet != false): ?>
        <div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">
            <?php echo $username?><br />
            <?php echo $now_tweet?><br />
            <?php echo $now_register_date?>
        </div>
    <?php endif; ?>

    <?php foreach ($news as $item): ?>
	    <div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">
            <?php echo $username?><br />
            <?php echo $item['tweet']?><br />
            <?php echo $item['register_date']?>
        </div>
    <?php endforeach; ?>

    <input type="submit" name="submit" value="もっと見る" />
</body>
</html>