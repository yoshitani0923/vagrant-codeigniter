<?php foreach ($news as $news_item): ?>

    <div id="main">
	    <?php echo $news_item['username'] ?>
        <?php echo $news_item['email'] ?>
        <?php echo $news_item['password'] ?>
    </div>

<?php endforeach ?>