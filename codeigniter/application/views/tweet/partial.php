<a href="/index.php/tweet/partial?offset=<?= $offset ?>">next</a>
<?php foreach ($news as $item): ?>
    <div style="padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">
        <?php echo $username?><br />
        <?php echo $item['tweet']?><br />
        <?php echo $item['register_date']?>
    </div>
<?php endforeach; ?>